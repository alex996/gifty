<?php

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Order.php');

require_once(MODEL_PATH . 'Address.php');

require_once(MODEL_PATH . 'OrderDetail.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'PaymentMethod.php');

require_once(MODEL_PATH . 'Promotion.php');

class OrderController {

	public function index() {

		if (!Auth::check())
			Router::redirect('login');

		//$customer = Customer::with('orders.address')->where('user_id', Auth::id())->get();

		$customer_id = Customer::where('user_id', Auth::id())->get()->id;
		$orders = Order::with('address')->where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();

		if (!is_array($orders) && $orders)
			$orders = [$orders];
		
		View::render('orders/index.php', [
			'orders' => $orders,
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
		]);

		/*$user = Auth::user();

		if ($user->isCustomer()) {
			$user->load('customer');

			if (!$user->customer)
				View::render('accounts/register.php');
			else {
				
				$user->customer->load('orders');

				View::render('accounts/orders.php', ['customer' => $user->customer]);
			}
		}
		else if ($user->isAdmin()) {
			echo "admin view orders ....";
		}*/
	}

	public function show($id) {

		if (!Auth::check())
			Router::redirect('login');

		$order = Order::with(['address', 'payment_method.address', 'order_details.product'])->find($id);

	    if (empty($order)) {
			View::render('errors/404.php', [
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
		} else {
			View::render('orders/details.php', [
				'order' => $order, 'in_cart' => Cart::count(),
				'categories' => Category::all(),
				'customer' => Customer::current(),

			]);
		}
	}

	public function update_quantity($order_id, $order_detail_id) {

		$errors = Validator::validate($_POST, [
			'quantity' => 'required|integer|minval:1|maxval:99',
		]);

		if (empty($errors)) {
			$order = Order::find($order_id);
			if ($order->status != Order::PENDING)
				$errors[] = "Order cannot be modified due to its status ({$order->status}).";
			else {
				$order_detail = OrderDetail::with('product')->find($order_detail_id);

				if (!$order_detail)
					$errors[] = "Order detail with id of {$order_detail_id} not found.";
				else if (!$order_detail->product)
					$errors[] = "No product was found for order detail with id of {$order_detail_id}";
				else if ($_POST['quantity'] > $order_detail->product->quantity)
					$errors[] = "Product quantity ({$_POST['quantity']}) exceeds quantity in stock.";
				else {
					// Check if product price (in stock) has recently changed.
					// To do that, we first need to apply promotion discount, if needed.
					$stock_price = $final_price = $order_detail->product->price;
					$promo = $order_detail->product->promotion();
					if ($promo) {
						$final_price = round(($stock_price - ($stock_price * $promo->discount)), 2);
					}
					if ($order_detail->price != $final_price)
						// TODO: consider giving the customer a choice to go with the updated price
						$errors[] = "Order cannot be modified due to a recent price change.";
					else {
						// Update order detail quantity
						$old_detail_qty = $order_detail->quantity;
						$new_detail_qty = $_POST['quantity'];
						$order_detail->quantity = $new_detail_qty;
						$order_detail->save();

						// Reload order_details, since one has just been changed
						$order->load('order_details');
						// Recalculate total
						$order->recalculate_total();

						// Update quantity in stock
						$diff = $old_detail_qty - $new_detail_qty;
						$old_stock_qty = $order_detail->product->quantity;
						$order_detail->product->quantity = $old_stock_qty + $diff;
						$order_detail->product->save();

						exit(json_encode(['status' => 1, 'total' => $order->total]));
					}
				}
			}
		}

		echo json_encode(['status' => 0, 'errors' => $errors]);
	}

	public function destroy_detail($order_id, $order_detail_id) {

		$order = Order::find($order_id);
		if ($order->status != Order::PENDING)
			$errors[] = "Order cannot be modified due to its status ({$order->status}).";
		else {
			$order_detail = OrderDetail::with('product')->find($order_detail_id);

			if (!$order_detail)
				$errors[] = "Order detail with id of {$order_detail_id} not found.";
			else if (!$order_detail->product)
				$errors[] = "No product was found for order detail with id of {$order_detail_id}";
			else {
				// Check if product price (in stock) has recently changed.
				// To do that, we first need to apply promotion discount, if needed.
				$stock_price = $final_price = $order_detail->product->price;
				$promo = $order_detail->product->promotion();
				if ($promo) {
					$final_price = round(($stock_price - ($stock_price * $promo->discount)), 2);
				}
				if ($order_detail->price != $final_price)
					// TODO: consider giving the customer a choice to go with the updated price
					$errors[] = "Order cannot be modified due to a recent price change.";
				else {
					// Update quantity in stock
					$added = $order_detail->quantity;
					$old_stock_qty = $order_detail->product->quantity;
					$order_detail->product->quantity = $old_stock_qty + $added;
					$order_detail->product->save();

					// Delete order detail
					$order_detail->delete();

					// Reload order_details, since one has just been changed
					$order->load('order_details');
					// Recalculate total
					$order->recalculate_total();

					if ($order->total == 0) {
						$order->status = Order::CANCELLED;
						$order->save();
					}

					exit(json_encode(['status' => 1, 'total' => $order->total]));
				}
			}
		}
		
		echo json_encode(['status' => 0, 'errors' => $errors]);
	}
}