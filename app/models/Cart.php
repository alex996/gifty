<?php

class Cart extends Model {
	
	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $customer_id;

	public $sess_id;

	public $created_at;

	public function cart_details() {
		return $this->hasMany('CartDetail');
	}

	public static function recent() {
		return Cart::where('customer_id', Customer::current()->id)->orderBy('created_at', 'DESC')->first();
	}

	public static function current() {
		return isset($_SESSION['cart_id']) ? Cart::with('cart_details.product')->find($_SESSION['cart_id']) : null;
	}

	public static function count() {
		$cart = Cart::current();
		if (!$cart)
			return 0;
		else {
			$count = 0;
			foreach($cart->cart_details as $detail)
				$count += $detail->quantity;
			return $count;
		}
	}
}

Cart::initialize();