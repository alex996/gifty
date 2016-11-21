<?php

require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

class AuthController extends Controller {

	public function showLogin() {

		if (Auth::check())
			Router::redirect('/');
		else
			View::render('auth/login.php', ['in_cart' => Cart::count()]);
	}

	public function login() {
		if (Auth::check())
			Router::redirect('/');
		else {
			// validate email and pass
			$auth_error = null;
			$errors = Validator::validate($_POST, [
				'email' => 'required|email|max:100',
				'password' => 'required|min:6'
			]);

			if (!empty($errors))
				$auth_error = reset($errors);
			else {
				$auth_error = Auth::attempt($_POST['email'], $_POST['password']);

				if (!$auth_error) {

					$cart = Cart::current();
					if (Auth::user()->isCustomer() && $cart) {
						$cart->customer_id = Customer::current()->id;
						$cart->save();
					}

					Router::redirect('/');
				}
			}

			View::render('auth/login.php', ['error' => $auth_error, 'in_cart' => Cart::count()]);
		}
	}

	public function showRegister() {
		if (Auth::check())
			Router::redirect('/');
		else
			View::render('auth/register.php', ['in_cart' => Cart::count()]);
	}

	public function register() {
		if (Auth::check())
			Router::redirect('/');
		else {
			$errors = Validator::validate($_POST, [
				'name' => 'required|max:100',
				'email' => 'required|email|unique:users,email|max:100',
				'password' => 'required|min:6'
			]);

			if (!empty($errors))
				View::render('auth/register.php', ['error' => reset($errors), 'in_cart' => Cart::count()]);
			else {
				// Create a new user
				User::create([
					'name' => $_POST['name'],
					'email' => $_POST['email'],
					'password' => Auth::hash($_POST['password']),
					'role' => User::CUSTOMER,
				]);
				// Sign in the user
				Auth::attempt($_POST['email'], $_POST['password']);
				// Redirect to profile
				Router::redirect('account');
			}
		}
	}

	public function logout() {
		if (Auth::check())
			Auth::logout();
		Router::redirect('/');
	}
}