<?php

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Order.php');

require_once(MODEL_PATH . 'OrderDetail.php');

require_once(MODEL_PATH . 'Address.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'PaymentMethod.php');

require_once(MODEL_PATH . 'Promotion.php');

class CheckoutController {

	public function show_shipping() {

		// Cannot make an order with an empty cart
		if (empty(Cart::current()))
			Router::redirect('/cart');
		// Customer must be registered before making orders
		else if (! Customer::current() )
			Router::redirect('/account');
		// If shipping info already provided, move on to payments
		else if (isset($_SESSION['address_id']))
			Router::redirect('/checkout/payment');

		View::render('checkout/shipping.php', [
			'in_cart' => Cart::count(),
			'addresses' => Customer::shipping_addresses(),
			'categories' => Category::all(),
		]);
	}

	public function store_shipping() {

		if (isset($_POST['address_id'])) {

			$address = Address::find($_POST['address_id']);

			if ($address) {
				$_SESSION['address_id'] = $_POST['address_id'];
				Router::redirect('/checkout/payment');
			} else {
				View::render('checkout/shipping.php', [
					'error' => "Selected address no longer exists. Please try again.",
					'in_cart' => Cart::count(),
					'categories' => Category::all(),
				]);
			}

		} else {

			$errors = Validator::validate($_POST, [
				'street' => 'required|max:255',
				'city' => 'required|max:50',
				'state' => 'required|max:50',
				'country' => 'required|max:50|in:US,CA',
				'zip' => 'required|zip',
			]);

			if (!empty($errors))
				View::render('checkout/shipping.php', [
					'errors' => $errors,
					'in_cart' => Cart::count(),
					'categories' => Category::all(),
				]);
			else {
				$address = Address::create([
					'street' => $_POST['street'],
					'city' => $_POST['city'],
					'state' => $_POST['state'],
					'country' => $_POST['country'],
					'zip' => $_POST['zip'],
				]);
				$_SESSION['address_id'] = $address->id;

				Router::redirect('/checkout/payment');
			}
		}
	}

	public function show_payment() {

		// Customer must provide shipping info first
		if (! isset($_SESSION['address_id']) )
			Router::redirect('/checkout/shipping');
		// If billing info already provided, move on to confirmation
		else if (isset($_SESSION['payment_method_id']))
			Router::redirect('/checkout/confirmation');

		View::render('checkout/payment.php', [
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
			'payment_methods' => Customer::payment_methods_with_addresses()
		]);
	}

	public function store_payment() {

		if (isset($_POST['address_id']) && isset($_POST['payment_method_id'])) {

			$address = Address::find($_POST['address_id']);
			$payment_method = PaymentMethod::find($_POST['payment_method_id']);

			if ($address && $payment_method) {
				$_SESSION['payment_method_id'] = $_POST['payment_method_id'];
				Router::redirect('/checkout/confirmation');
			} else {
				View::render('checkout/payment.php', [
					'error' => "Selected payment method no longer exists. Please try again.",
					'in_cart' => Cart::count(),
					'categories' => Category::all(),
				]);
			}

		} else {

			$errors = Validator::validate($_POST, [
				'cardholder' => 'required|max:100',
				'card_number' => 'required|alphanum_dash|max:25',
				'type' => 'required|in:VISA,MASTERCARD,INTERAC',
				'cvv' => 'required|digits|size:3',
				'expiry_month' => 'required|digits',
				'expiry_year' => 'required|digits|size:4',
				'street' => 'required|max:255',
				'city' => 'required|max:50',
				'state' => 'required|max:50',
				'country' => 'required|max:50|in:US,CA',
				'zip' => 'required|zip',
			]);

			if (!empty($errors)) {
				View::render('checkout/payment.php', [
					'errors' => $errors,
					'in_cart' => Cart::count(),
					'categories' => Category::all(),
				]);
			}
			else {
				$address = Address::create([
					'street' => $_POST['street'],
					'city' => $_POST['city'],
					'state' => $_POST['state'],
					'country' => $_POST['country'],
					'zip' => $_POST['zip'],
				]);

				/*
					'Fake' payment method processor.
				*/
				$last_digits = substr( str_replace('-', '', $_POST['card_number']), -4);

				$payment_method = PaymentMethod::create([
					'customer_id' => Customer::current()->id,
					'type' => $_POST['type'],
					'cardholder' => $_POST['cardholder'],
					'last_digits' => $last_digits,
					'address_id' => $address->id
				]);

				$_SESSION['payment_method_id'] = $payment_method->id;

				Router::redirect('/checkout/confirmation');
			}
		}
	}

	public function show_confirmation() {
		// Customer must provide billing info first
		if (! isset($_SESSION['payment_method_id']) )
			Router::redirect('/checkout/payment');
		
		$cart = Cart::current();

		View::render('checkout/confirmation.php', [
			'customer' => Customer::current(),
			'cart' => $cart,
			'in_cart' => Cart::count(),
			'total' => $cart->total(),
			'address' => Address::find($_SESSION['address_id']),
			'payment_method' => PaymentMethod::with('address')->find($_SESSION['payment_method_id'])
		]);
	}

	public function confirm() {

		$customer = Customer::current();
		$cart = Cart::current();
		$address_id = $_SESSION['address_id'];
		$payment_method_id = $_SESSION['payment_method_id'];

		// Create an order
		$order = Order::create([
			'customer_id' => $customer->id,
			'address_id' => $address_id,
			'payment_method_id' => $payment_method_id,
			'status' => Order::PENDING,
			'total' => $cart->total(),
			'created_at' => date('Y-m-d G:i:s'),
		]);

		foreach($cart->cart_details as $cart_detail) {
			// Create an order_detail
			$promo = $cart_detail->product->promotion();
			if (!empty($promo)) // promo price must be applied
				$price = round($cart_detail->product->price - ($cart_detail->product->price * $promo->discount), 2);
			else
				$price = $cart_detail->product->price; // current price

			$order_detail = OrderDetail::create([
				'order_id' => $order->id,
				'product_id' => $cart_detail->product_id,
				'price' => $price, // current price
				'quantity' => $cart_detail->quantity,
			]);
			// Decrement quantity in stock
			$cart_detail->product->quantity -= $cart_detail->quantity;
			$cart_detail->product->save();
			// Delete the cart detail
			$cart_detail->delete();
		}

		// Delete the cart
		$cart->delete();

		// Unset session vars
		unset($_SESSION['address_id']);
		unset($_SESSION['payment_method_id']);
		unset($_SESSION['cart_id']);

		// Set a flag to indicate successful purchase
		$_SESSION['order_id'] = $order->id;

		Router::redirect('checkout/success');
	}

	public function success() {

		// Customer must confirm the order first
		if (! isset($_SESSION['order_id']))
			Router::redirect('/checkout/confirmation');

		// Get the order with its shipping address
		// and payment method + billing address
		$order = Order::with(['address', 'payment_method.address'])
							->find($_SESSION['order_id']);
		unset($_SESSION['order_id']);

		View::render('/checkout/success.php', [
			'customer' => Customer::current(),
			'in_cart' => 0,
			'order' => $order
		]);

	}
}