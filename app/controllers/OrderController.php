<?php

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Order.php');

require_once(MODEL_PATH . 'Address.php');

require_once(MODEL_PATH . 'OrderDetail.php');

require_once(MODEL_PATH . 'Product.php');

class OrderController {

	public function index() {

		if (!Auth::check())
			Router::redirect('login');

		//$customer = Customer::with('orders.address')->where('user_id', Auth::id())->get();

		$customer_id = Customer::where('user_id', Auth::id())->get()->id;
		$orders = Order::with('address')->where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();

		View::render('orders/index.php', ['orders' => $orders]);

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

		$order = Order::with('order_details.product')->find($id);

		View::render('orders/details.php', ['order' => $order]);

	}

}