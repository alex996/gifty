<?php

class VerifyNonAuth {

	public static function handle() {

		if (Auth::check())
			Router::redirect('/');
	}
}