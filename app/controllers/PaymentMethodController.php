<?php

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'PaymentMethod.php');

require_once(MODEL_PATH . 'Address.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

class PaymentMethodController {

	public function index() {

		if (!Auth::check())
			Router::redirect('login');
		else if (! Auth::user()->customer())
			Router::redirect('account');

		$customer = Customer::with('payment_methods.address')->where('user_id', Auth::id())->get();

		View::render('payment_methods/index.php', [
			'customer' => $customer,
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
		]);

	}

}