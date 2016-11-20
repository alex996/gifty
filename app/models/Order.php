<?php

<<<<<<< HEAD
class Order extends Model {
=======
class Order {
>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2

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

<<<<<<< HEAD
	const PENDING = 'PENDING';
	
	const APPROVED = 'APPROVED';
	
	const DELIVERED = 'DELIVERED';
	
	const CANCELLED = 'CANCELLED';
	
	const ERROR = 'ERROR';

=======
>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2
	public function customer() {
		return $this->belongsTo('Customer');
	}

	public function address() {
		return $this->hasOne('Address');
	}

	public function payment_method() {
<<<<<<< HEAD
		return $this->hasOne('PaymentMethod');
	}

	public function order_details() {
		return $this->hasMany('OrderDetail');
	}
}

Order::initialize();
=======
		return $this->hasOne('PaymentMethod')
	}


}
>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2
