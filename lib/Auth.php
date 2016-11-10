<?php

class Auth {

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

	public static function logged() {
		return isset($_SESSION["auth_id"]);
	}

	public static function logout() {
		unset($_SESSION['auth_id']);
	}

	public static function user() {
		return isset($_SESSION["auth_id"]) ? User::find($_SESSION["auth_id"]) : null;
	}

	public static function id() {
		return isset($_SESSION["auth_id"]) ? $_SESSION["auth_id"] : null;
	}

	public static function error() {
		return isset($_SESSION["auth_error"]) ? $_SESSION["auth_error"] : null;
	}

	public static function hash($password) {
		return password_hash($password, PASSWORD_DEFAULT);
	}
}