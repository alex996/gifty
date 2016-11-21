<?php

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'PaymentMethod.php');

require_once(MODEL_PATH . 'Address.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

class PaymentMethodController {

	public function index() {

		if (!Auth::check())
			Router::redirect('login');

		$customer = Customer::with('payment_methods.address')->where('user_id', Auth::id())->get();

		View::render('payment_methods/index.php', ['customer' => $customer, 'in_cart' => Cart::count()]);

	}

}