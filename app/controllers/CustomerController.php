<?php

require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

class CustomerController extends Controller {

	/* RESTful routes:
		
		/customers

	 */

	public function index() {
		echo "here";
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
			View::render('accounts/register.php', [
				'errors' => $errors,
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
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

	public function show() {
		if (!Auth::check())
			Router::redirect('login');

		View::render('accounts/profile.php', [
			'user' => User::with('customer')->find(Auth::id()),
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
		]);
	}

	public function update_phone() {
		if (!Auth::check())
			Router::redirect('login');

		$errors = Validator::validate($_POST, [
			'phone' => 'required|phone',
		]);

		$user = User::with('customer')->find(Auth::id());

		if (!empty($errors))
			View::render('accounts/profile.php', [
				'user' => $user,
				'error' => reset($errors),
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
		else {
			$user->customer->phone = $_POST['phone'];
			$user->customer->save();
			View::render('accounts/profile.php', [
				'user' => $user,
				'success' => 'Phone number updated.',
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
		}
	}

}