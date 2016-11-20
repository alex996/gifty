<?php


I. with() called on DB, expects the name of the relationship method defined on the model


ex 1:

$u = User::with('customer')->all();
each User will have $customer var set to Customer obj or null

ex 2:

$u = User::with('customer')->find(6);
print_r($u);

II. relationship method, called on Model subclass (e.g. User or Order)

ex 1:

$u = User::find(1); 
$cust = $u->customer(); // this fetches the customer and returns it into $cust var
// $u will NOT have $customer var

ex 2:
$u = User::find(1)->customer();  // u can also chain it, because find() returns a User,
								// and customer() is called on User

III. load() -- Load relationship into an object

ex 1:

$u = User::find(6);
$u->load('customer'); // Name of the relationship METHOD
$u->customer; -> returns Customer obj

ex 2:
// You can also chain it, but make sure that 
// load is called on a single object, and not on
// an array or null
$u = User::find(6)->load('customer');
$u->customer; -> returns Customer obj

class TEST {
	
	
	PaymentMethod::hasOne('Address');
	
	hasOne() {
		// ex1
		
		$foreign_key = 'address_id'; // --> 5
		$this->$foreign_key // -> 5
		
		return Address::find(5)
		
		
		//ex2
		
		
		
	}
	
	hasMany() {
		ex1
		Customers has Many PaymentMethods
		
		return PaymentMethods::where('customer_id', $this->id)
		ex2
		Product has many reviews
		
		return Review::where('product_id', $this->id)
		
		ex3
		a category has many products
		
		Product::where('category_id', $this->id)
		
	}
	
	belongsTo() {
		
		ex1
		
		order_detail belongs to an order
		
		return Order::find($this->order_id)
		
		ex2
		
		cart_details belongs to a cart_details
		
		return Cart::find($this->cart_id)
		
		ex3
		
		Many Products belongs to a single category
		
		$foreign_key = "category_id"
		
	}
	
	belongsToMany() {
		
		address belongs to many payment methods
		
		PaymentMethod::where('address_id', $this->id)

		
	}
}