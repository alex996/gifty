<?php

require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Order.php');

require_once(MODEL_PATH . 'Address.php');

class AccountController extends Controller {

	public function index() {
		
		if (!Auth::check())
			Router::redirect('login');

<<<<<<< HEAD
=======
		//print_r(ModelResolver::$class_table);die();
		//

		/*$u = User::with('customer')->all();
		foreach($u as $user) {
			print_r($user);
			echo "<br>";
		}die();*/

		/*$pm = PaymentMethod::find(1);
		print_r($pm->address());die();*/

		$u = User::find(6)->load('customer');
		print_r($u->customer);
		/*echo "<br>";
		$u->load('customer');
print_r($u);*/

		die();


>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2
		$user = Auth::user();

		if ($user->isCustomer()) {
			$user->load('customer');

			if (!$user->customer)
				View::render('accounts/register.php');
			else {
				/*$user->customer->load('payment_method');

				$pm = $user->customer->payment_method;
				$payment_methods = is_array($pm) ? $pm : [$pm];
				foreach ($payment_methods as $method)
					$method->load('address');*/

				$order = Order::with('address')->where('customer_id', $user->customer->id)->orderBy('created_at', 'DESC')->first();
			
				View::render('accounts/home.php', ['user' => $user, 'order' => $order]);
			}
		}
		else if ($user->isAdmin()) {
			echo "admin dashboard....";
		}



		/*$user = Auth::user();
		$user->load('customer');
		
		if (!$user->customer) {
			View::render('accounts/register.php');
		} else {
			print_r($user->customer);
		}*/

	}
}