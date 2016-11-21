<?php

class CartDetail extends Model {
	
	protected static $class;

	protected static $table = 'cart_details';

	protected static $fillable;

	public $id;

	public $cart_id;

	public $product_id;

	public $quantity;

	public function product() {
		return $this->hasOne('Product');
	}
}

CartDetail::initialize();