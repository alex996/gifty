<?php

class Customer extends Model {

	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $user_id;

	public $first;

	public $last;

	public $dob;

	public $phone;
}

Customer::initialize();