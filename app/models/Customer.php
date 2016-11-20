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
<<<<<<< HEAD

	public function payment_methods() {
		return $this->hasMany('PaymentMethod');
	}
=======
>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2
}

Customer::initialize();