<?php

// Load the User model:
require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'Product.php');

class UserController extends Controller {

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

		
		
/*		$u = User::create([
			'name' => 'test',
			'email' => 'testasdf122',
			'password' => Auth::hash('12456'),
			'role' => User::ADMIN
		]);
		print_r($u);
		echo "<br><br>";*/



		print_r( Cart::orderby('created_at', 'DESC')->first() );

/*		$u_new = User::find($u->id);
		print_r($u_new);
		echo "<br><br>";

		$c_new = Cart::find($c->id);
		print_r($c);
		echo "<br><br>";*/

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
