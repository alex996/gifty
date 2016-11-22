<?php

require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

require_once(CTRL_PATH . 'traits/CartTrait.php');

class AuthController extends Controller {

	use CartTrait;

	public function show_login() {

		if (Auth::check())
			Router::redirect('/');
		else
			View::render('auth/login.php', [
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
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

					if (Auth::user()->isCustomer()) {
						// Process the cart
						CartTrait::process();
						Router::redirect('/');
					}
					else // isAdmin
						Router::redirect('dashboard');
				}
			}

			View::render('auth/login.php', [
				'error' => $auth_error,
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
		}
	}

	public function show_register() {
		if (Auth::check())
			Router::redirect('/');
		else
			View::render('auth/register.php', [
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
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
				View::render('auth/register.php', [
					'error' => reset($errors),
					'in_cart' => Cart::count(),
					'categories' => Category::all(),
				]);
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