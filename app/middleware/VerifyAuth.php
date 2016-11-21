<?php

class VerifyAuth {
	
	public static function handle() {

		if (!Auth::check())
			Router::redirect('login');
	}
	
}