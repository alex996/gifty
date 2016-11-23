<?php

class Order extends Model {

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

	const PENDING = 'PENDING';
	
	const APPROVED = 'APPROVED';
	
	const DELIVERED = 'DELIVERED';
	
	const CANCELLED = 'CANCELLED';
	
	const ERROR = 'ERROR';

	public function customer() {
		return $this->belongsTo('Customer');
	}

	public function address() {
		return $this->hasOne('Address');
	}

	public function payment_method() {
		return $this->hasOne('PaymentMethod', 'payment_method_id');
	}

	public function order_details() {
		return $this->hasMany('OrderDetail');
	}

	public function recalculate_total() {
		$total = 0;
		foreach($this->order_details as $detail)
			$total += $detail->price * $detail->quantity;
		$this->total = $total;
		$this->save();
	}
}

Order::initialize();