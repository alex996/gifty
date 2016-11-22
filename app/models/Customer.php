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

	public function user() {
		return $this->belongsTo('User');
	}

	public function orders() {
		return $this->hasMany('Order');
	}

	public function payment_methods() {
		return $this->hasMany('PaymentMethod');
	}




	public static function current() {
		return Auth::id() ? Customer::where('user_id', Auth::id())->get() : null;
	}

	public static function shipping_addresses() {
		$orders = Order::where('customer_id', Customer::current()->id)
								->orderBy('created_at', 'DESC')->select('DISTINCT address_id');
		if (!is_array($orders)) $orders = [$orders];

		$addresses = [];
		foreach($orders as $order)
			if (!empty($order))
				$addresses[] = Address::find($order->address_id);

		return $addresses;
	}

	public static function payment_methods_with_addresses() {
		$methods = PaymentMethod::with('address')->where('customer_id', Customer::current()->id)->get();
		return is_array($methods) ? $methods : [$methods];
	}
}

Customer::initialize();