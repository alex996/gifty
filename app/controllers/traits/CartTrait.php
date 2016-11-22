<?php

trait CartTrait {
    
	public function process() {

		$customer_id = Customer::current()->id;
		// Fetch the current cart in session, if any
		$cart = Cart::current();
								
		if ($cart) {

			if ($cart->isAuthenticated()) {
				// If cart is authenticated, but belongs to a
				// different customer, switch to your own cart
				if ($cart->customer_id != $customer_id) {
					// Load the most recent cart, if any
					$cart = Cart::where('customer_id', $customer_id)
							->orderBy('created_at', 'DESC')->first();
					// If no cart found, then reinitialize the cart
					if (!cart)
						$cart = CartTrait::setup();

					// Store cart_id in session
					$_SESSION['cart_id'] = $cart->id;
				}
				// Else, update the session id if needed
				else {
					$session_id = session_id();
					if ($cart->sess_id != $session_id) {
						$cart->sess_id = $session_id;
						$cart->save();
					}
				}
			} else {
				// If the cart does exist and is anonymous, we need
				// to authenticate it with the current customer
				$cart->customer_id = $customer_id;
				$cart->save();
			}
		}
		else {
			// Load the most recent cart, if any
			$cart = Cart::where('customer_id', $customer_id)
							->orderBy('created_at', 'DESC')->first();
			// If cart is found, store its id in session and update sess_id.
			// Else, the cart will be created once a product is added to it
			if ($cart) {
				// Store cart_id in session
				$_SESSION['cart_id'] = $cart->id;
				// Update cart session id
				$cart->sess_id = session_id();
			}
		}
	}

	public static function setup() {
		// Get the current customer
		$customer = Customer::current();
		// Create a new cart
		$cart = Cart::create([
			'customer_id' => ($customer) ? $customer->id : null,
			'sess_id' => session_id(),
			'created_at' => date("Y-m-d H:i:s"),
		]);
		// Store cart_id in session
		$_SESSION['cart_id'] = $cart->id;
		// There aren't any cart details to load, but this will
		// create $cart->cart_details instance var
		$cart->load('cart_details');

		return $cart;
	}

}