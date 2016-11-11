<?php

class User extends Model {

	public $id;

	public $name;

	public $email;

	public $password;

	public $role;

	const ADMIN = 'ADMIN';

	const CUSTOMER = 'CUSTOMER';

	public function __construct() { }
}

User::initialize();