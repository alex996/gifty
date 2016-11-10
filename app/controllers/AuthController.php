<?php

require_once(LIB_PATH . 'Auth.php');

require_once(LIB_PATH . 'Validator.php');

class AuthController extends Controller {

	public function showLogin() {
		View::render('auth/login.php');
	}

	public function login() {
		// validate email and pass
	}

	public function showRegister() {
		View::render('auth/register.php');
	}

	public function register() {
		
	}

	public function logout() {
		
	}
}