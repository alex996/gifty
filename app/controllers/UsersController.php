<?php

require MODEL_PATH . 'User.php';

class UsersController {

	public static function index() {
		$stmt = DB::run("SELECT * FROM users");

		while ($row = $stmt->fetch(PDO::FETCH_LAZY))
		{
		    echo $row['name'],",";
		    echo $row->name,",";
		    echo $row[1], PHP_EOL;
		}

		/*User::create([
			'name' => 'Josh',
			'email' => 'josh@gmail.com',
			'password' => '123456',
			'role' => 'ADMIN'
		]);*/

		$user = User::all();
		print_r($user);
	}

}
