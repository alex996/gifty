<?php

class OrderDetail extends Model {

	protected static $class;

	protected static $table = "order_details";

	protected static $fillable;

	public $id;

	public $order_id;

	public $product_id;

	public $price;

	public $quantity;

	public function product() {
		return $this->hasOne('Product');
	}
}

OrderDetail::initialize();