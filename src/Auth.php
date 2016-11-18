<?php

require_once(MODEL_PATH . 'User.php');

class Auth {

	public static $user = null;

	/**
	 * Attempt to authenticate with email and password.
	 */
	public static function attempt($email, $password) {
		$user = User::where('email', $email)->first();
		$error = null;

		if ($user) {
			if (password_verify($password, $user->password)) {
				$_SESSION["auth_id"] = $user->id;
				self::$user = $user;
			}
			else
				$error = "Incorrect password. Try again.";
		}
		else
			$error = "Incorrect email. Try again.";

		return $error;
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
		self::$user = null;
	}

	/**
	 * Get authenticated user.
	 */
	public static function user() {
		if (self::check() && !self::$user)
			self::$user = User::find($_SESSION["auth_id"]);

		return self::$user;
		//return self::check() ? User::find($_SESSION["auth_id"]) : null;
	}

	/**
	 * Get authenticated user's id.
	 */
	public static function id() {
		return self::user() ? self::$user->id : null;
		//return self::check() ? $_SESSION["auth_id"] : null;
	}

	/**
	 * Create a password hash.
	 */
	public static function hash($password) {
		return password_hash($password, PASSWORD_DEFAULT);
	}
}