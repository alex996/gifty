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

		print_r(User::all());

		echo "<br><br><br>";

		
		//User::create([]);

		$u = new User();
		$u->name = 'Alex';
		$u->save();

		// get by id
		//$res = DB::table('users')->where('id', 1)->get();

		// get all
		//$res = DB::table('users')->orderby('name', 'desc')->all();
		//$res = DB::table('users')->where('name', 'alex')->where('email', 'alex@gmail.com')->all();

		// insert
		/*DB::table('users')->insert([
			'name' => 'Michael',
			'email' => 'michael@gmail.com',
			'password' => password_hash('123456', PASSWORD_DEFAULT),
			'role' => 'CUSTOMER'
		]);*/

		//update
		/*DB::table('users')->where('id', 1)->update([
			'email' => 'alex@gmail.com',
			'name' => 'Alex'
		]);*/

		// delete
		//DB::table('users')->where('name', 'Michael')->delete();

		//print_r($res);



		/*$res = DB::select()->from('users')->where('id', 1)->orderby('name')->exec();
		DB::insert()->into('users')->values([
			'name' => 'Alex'
		]);
		DB::delete()->from('users')->where('id', 1)->exec();
		DB::update('users')->set([
			'name' => 'Alex'
		])->where('id', 1)->exec()*/



		/*DB::table('users')->where('id', 1)->update(['name' => 'Alex'])

		while ($row = $res->fetchObject('User'))
		{
		    print_r($row);
		}*/

		/*User::create([
			'name' => 'josh',
			'email' => 'josh@gmail.com',
			'password' => password_hash('123456', PASSWORD_DEFAULT),
			'role' => 'ADMIN'
		]);*/

		/*User::create([
			'name' => 'Josh',
			'email' => 'josh@gmail.com',
			'password' => '123456',
			'role' => 'ADMIN'
		]);*/

		//$user = User::all();
		//print_r($user);
	}

}
