<?php

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(CTRL_PATH . 'traits/CartTrait.php');

class CartController {

	use CartTrait;

	public function index() {

		View::render('/cart/index.php', [
			'cart' => Cart::current(),
			'in_cart' => Cart::count()
		]);
	}

	public function store() {

		$errors = Validator::validate($_POST, [
			'product_id' => 'required|integer|min:1',
			'quantity' => 'required|integer|min:1|max:99',
		]);

		if (empty($errors)) {
			// Get the current cart
			$cart = Cart::current();

			// If cart does not exist, create it
			if (!$cart)
				$cart = CartTrait::setup();

			// Try to find the cart detail
			$cart_detail = null;
			foreach($cart->cart_details as $cd)
				if ($cd->product_id == $_POST['product_id'])
					$cart_detail = $cd;

			if ($cart_detail) {
				$cart_detail->quantity = $cart_detail->quantity + $_POST['quantity'];
				$cart_detail->save();
			} else {
				CartDetail::create([
					'cart_id' => $cart->id,
					'product_id' => $_POST['product_id'],
					'quantity' => $_POST['quantity'],
				]);
			}

			echo json_encode(['status' => 1]);
		}
		else
			echo json_encode(['status' => 0, 'errors' => $errors]);
	}

	public function show() {

	}

	public function update($id) {
		$errors = Validator::validate($_POST, [
			'quantity' => 'required|integer|min:1|max:99',
		]);

		if (empty($errors)) {
			$cart_detail = CartDetail::find($id);
			$cart_detail->quantity = $_POST['quantity'];
			$cart_detail->save();

			//echo json_encode(['status' => 1]);
		} else {
			//echo json_encode(['status' => 0, 'errors' => $errors]);
		}

		Router::redirect('/cart');
	}

	public function destroy($id) {
		CartDetail::find($id)->delete();
		Router::redirect('/cart');
	}
	
}