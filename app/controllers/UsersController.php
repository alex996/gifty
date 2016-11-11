<?php

// Load the User model:
require_once(MODEL_PATH . 'User.php');

class UsersController extends Controller {

	public function index() {

		/*$u = User::find(1);
		print_r($u);*/

		/*print_r($u = User::create([
			'name'=>'Mark',
			'email'=>'mark@gmail.com',
			'password' => '123456',
			'somethinelse' => 'asdfasdfasd',
			'role'=> User::CUSTOMER
		]));*/

		/*echo "<br>";
echo Auth::hash('1234567345674356');
		$u = Auth::id();
		if (!$u)
			echo "user is meesed up<br>";
		print_r($u);

		echo (Auth::logged()) ? "<br>logged in<br><br>" : "<br>not logged in<br><br>";

		/*if (Auth::attempt('alex@gmail.com','123456')) {
			echo 'logged in!!!!!!';
		}
		else
			echo Auth::error();

		Auth::logout();*/
	}
}
