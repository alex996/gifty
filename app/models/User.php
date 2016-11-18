<?php

class User extends Model {

	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $name;

	public $email;

	public $password;

	public $role;

	const ADMIN = 'ADMIN';

	const CUSTOMER = 'CUSTOMER';

	public function __construct() { }

	public function customer() {
		// shouldn't actually have many, but design theoretically allows that
		// so you can have many customers with the same ID
		$customers = $this->hasMany('Customer');
		// Return first customer
		return reset($customers);
	}

	public function isAdmin() {
		return $this->role === self::ADMIN;
	}

	public function isCustomer() {
		return $this->role === self::CUSTOMER;
	}
}

User::initialize();