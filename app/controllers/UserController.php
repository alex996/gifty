<?php

require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'Product.php');

class UserController extends Controller {

	public function index() {

	}

	public function edit_password() {

		if (!Auth::check())
			Router::redirect('login');

		View::render('accounts/security.php', []);

	}

	public function update_password() {

		if (!Auth::check())
			Router::redirect('login');

		$errors = Validator::validate($_POST, [
			'old_password' => 'required|min:6|user_password',
			'password' => 'required|min:6',
			'password_confirmation' => 'required|min:6|same:'.$_POST['password'],
		]);

		if (!empty($errors))
			View::render('accounts/security.php', ['error' => reset($errors)]);
		else {
			$user = Auth::user();
			$user->password = Auth::hash($_POST['password']);
			$user->save();
			View::render('accounts/security.php', ['success' => 'Password updated.']);
		}

	}
}
