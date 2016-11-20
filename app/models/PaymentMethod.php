<?php

class PaymentMethod extends Model {

	protected static $class;

	protected static $table = "payment_methods";

	protected static $fillable;

	public $id;

	public $customer_id;

	public $type;

	public $cardholder;

	public $last_digits;

	public $address_id;

	public function address() {
		return $this->hasOne('Address');
	}
}

PaymentMethod::initialize();