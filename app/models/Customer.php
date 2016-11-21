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
}

Customer::initialize();