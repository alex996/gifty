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

	public function isAnonymous() {
		return empty($this->customer_id);
	}

	public function isAuthenticated() {
		return ! empty($this->customer_id);
	}


	public static function recent() {
		return Cart::where('customer_id', Customer::current()->id)->orderBy('created_at', 'DESC')->first();
	}

	public static function current() {
		return isset($_SESSION['cart_id']) ? Cart::with('cart_details.product')->find($_SESSION['cart_id']) : null;
	}

	public function total() {
		$total = 0;
		foreach($this->cart_details as $detail) {
			if ($detail->product->promotion_id) {
				// Calculate discount
				$discount = $detail->product->promotion()->discount;
				$diff = $detail->product->price * $discount;
				$final = $detail->product->price - $diff;
			}
			else
				$final = $detail->product->price;
			
			$total += $final;
		}
		return $total;
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