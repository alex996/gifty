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

<<<<<<< HEAD
	const VISA = 'VISA';

	const MASTERCARD = 'MASTERCARD';

	const INTERAC = 'INTERAC';	

=======
>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2
	public function address() {
		return $this->hasOne('Address');
	}
}

PaymentMethod::initialize();