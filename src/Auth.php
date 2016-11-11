<?php

class Auth {

	/**
	 * Attempt to authenticate with email and password.
	 */
	public static function attempt($email, $password) {
		$user = User::search('email', $email);
		$error = '';

		if ($user) {
			if (password_verify($password, $user->password)) {
				$_SESSION["auth_id"] = $user->id;
				return true;
			}
			else
				$error = "Incorrect password. Try again.";
		}
		else
			$error = "Incorrect email. Try again.";

		$_SESSION['auth_error'] = $error;

		return false;
	}

	/**
	 * Check if authenticated.
	 */
	public static function check() {
		return isset($_SESSION["auth_id"]);
	}

	/**
	 * Logout.
	 */ 
	public static function logout() {
		unset($_SESSION['auth_id']);
	}

	/**
	 * Get authenticated user.
	 */
	public static function user() {
		return self::check() ? User::find($_SESSION["auth_id"]) : null;
	}

	/**
	 * Get authenticated user's id.
	 */
	public static function id() {
		return self::check() ? $_SESSION["auth_id"] : null;
	}

	/**
	 * Get authentication error.
	 */
	public static function error() {
		return isset($_SESSION["auth_error"]) ? $_SESSION["auth_error"] : null;
	}

	/**
	 * Create a password hash.
	 */
	public static function hash($password) {
		return password_hash($password, PASSWORD_DEFAULT);
	}
}