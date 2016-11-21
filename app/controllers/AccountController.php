<?php

require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Order.php');

require_once(MODEL_PATH . 'Address.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

class AccountController extends Controller {

	public function index() {
		
		if (!Auth::check())
			Router::redirect('login');

		$user = Auth::user();

		if ($user->isCustomer()) {
			$user->load('customer');

			if (!$user->customer)
				View::render('accounts/register.php', ['in_cart' => Cart::count()]);
			else {
				/*$user->customer->load('payment_method');

				$pm = $user->customer->payment_method;
				$payment_methods = is_array($pm) ? $pm : [$pm];
				foreach ($payment_methods as $method)
					$method->load('address');*/

				$order = Order::with('address')->where('customer_id', $user->customer->id)->orderBy('created_at', 'DESC')->first();
			
				View::render('accounts/home.php', ['user' => $user, 'order' => $order, 'in_cart' => Cart::count()]);
			}
		}
		else if ($user->isAdmin()) {
			echo "admin dashboard....";
		}

	}
}