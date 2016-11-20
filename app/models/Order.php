<?php

class Order {

	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $customer_id;

	public $address_id;

	public $payment_method_id;

	public $status;

	public $total;

	public $created_at;

	public function customer() {
		return $this->belongsTo('Customer');
	}

	public function address() {
		return $this->hasOne('Address');
	}

	public function payment_method() {
		return $this->hasOne('PaymentMethod')
	}


}