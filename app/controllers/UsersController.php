<?php

require_once(MODEL_PATH . 'User.php');

require_once(LIB_PATH . 'Auth.php');

class UsersController extends Controller {

	public function index() {
		/*$stmt = DB::run("SELECT * FROM users");

		while ($row = $stmt->fetch(PDO::FETCH_LAZY))
		{
		    echo $row['name'],",";
		    echo $row->name,",";
		    echo $row[1], PHP_EOL;
		}

		print_r(User::all());
*/

/*		User::create([
			'name' => 'Alex',
			'email' => 'alex@gmail.com',
			'password' => Auth::hash('123456'),
			'role' => 'ADMIN'
		]);*/
		echo "<br>";
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
			echo Auth::error();*/

		Auth::logout();
	}
}
