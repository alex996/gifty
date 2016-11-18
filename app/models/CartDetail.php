<?php

class CartDetail extends Model {
	
	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $cart_id;

	public $product_id;

	public $quantity;

	public function __construct() { }
}

CartDetail::initialize();