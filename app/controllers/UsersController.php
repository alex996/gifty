<?php

require MODEL_PATH . 'User.php';

require LIB_PATH . 'Auth.php';

class UsersController {

	public static function index() {
		/*$stmt = DB::run("SELECT * FROM users");

		while ($row = $stmt->fetch(PDO::FETCH_LAZY))
		{
		    echo $row['name'],",";
		    echo $row->name,",";
		    echo $row[1], PHP_EOL;
		}

		print_r(User::all());
*/
		echo "gotcha";

		print_r(Auth::user());
	}
}
