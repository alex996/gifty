<?php

require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'PaymentMethod.php');

require_once(MODEL_PATH . 'Address.php');

class AccountController extends Controller {

	public function index() {
		
		if (!Auth::check())
			Router::redirect('login');

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
			
				View::render('accounts/home.php', ['user' => $user]);
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

	public function store() {
		if (!Auth::check())
			Router::redirect('login');

		$errors = Validator::validate($_POST, [
			'first' => 'required|max:50',
			'last' => 'required|max:50',
			'dob' => 'required|date',
			'phone' => 'required|phone',
		]);

		if (!empty($errors))
			View::render('accounts/register.php', ['errors' => $errors]);
		else {
			Customer::create([
				'user_id' => Auth::id(),
				'first' => $_POST['first'],
				'last' => $_POST['last'],
				'dob' => $_POST['dob'],
				'phone' => $_POST['phone'],
			]);

			Router::redirect('account');
		}
	}

}