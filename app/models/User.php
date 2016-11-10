<?php

class User extends Model {

	public $id;

	public $name;

	public $email;

	public $password;

	public $role;

	public function __construct() {
		parent::__construct();

		//self::$class = 
	}

	/*public static function create($args) {
		//$user->toArray()
		$args['password'] = password_hash($args['password'], PASSWORD_DEFAULT);
		DB::run('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)', $args);
	}*/

	/*public static function find($id) {
		return DB::run('SELECT * FROM users WHERE id = :id', ['id' => $id])->fetchObject('User');
	}

	public static function all() {
		return DB::run('SELECT * FROM users')->fetchAll(PDO::FETCH_CLASS, 'User');
	}*/


	/*public function save($obj) {
		DB::run("UPDATE users SET name = :name, email = :email, password := password, role = :role", $user->toArray());
	}*/

}

User::__static();