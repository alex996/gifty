<?php

class Cart extends Model {
	
	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $customer_id;

	public $sess_id;

	public $created_at;
}

Cart::initialize();