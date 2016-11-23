<?php

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

require_once(CTRL_PATH . 'traits/CartTrait.php');

class CartController {

	use CartTrait;

	public function index() {

		View::render('/cart/index.php', [
			'cart' => Cart::current(),
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
		]);
	}

	public function store() {

		$errors = Validator::validate($_POST, [
			'product_id' => 'required|integer|min:1',
			'quantity' => 'required|integer|min:1|max:99',
		]);

		if (empty($errors)) {

			// Fetch the product
			$product = Product::find($_POST['product_id']);

			if (empty($product))
				$errors[] = "Product with id of {$_POST['product_id']} not found.";
			else if ($_POST['quantity'] > $product->quantity)
				$errors[] = "Product quantity ({$_POST['quantity']}) exceeds quantity in stock.";
			else {

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

				exit(json_encode(['status' => 1]));
			}
		}

		echo json_encode(['status' => 0, 'errors' => $errors]);
	}

	public function show() {

	}

	public function update($id) {
		$errors = Validator::validate($_POST, [
			'quantity' => 'required|integer|min:1|max:99',
		]);

		if (empty($errors)) {

			$cart_detail = CartDetail::with('product')->find($id);
			$product = $cart_detail->product;

			if (empty($product))
				$errors[] = "Product with id of {$cart_detail->product_id} not found.";
			else if ($_POST['quantity'] > $product->quantity)
				$errors[] = "Product quantity ({$_POST['quantity']}) exceeds quantity in stock.";
			else {
				$cart_detail->quantity = $_POST['quantity'];
				$cart_detail->save();

				exit(json_encode(['status' => 1, 'in_cart' => Cart::count()]));
			}
		} 

		echo json_encode(['status' => 0, 'errors' => $errors]);
	}

	public function destroy($id) {
		$cart_detail = CartDetail::find($id);
		if ($cart_detail) {
			CartDetail::find($id)->delete();
			echo json_encode(['status' => 1, 'in_cart' => Cart::count()]);
		} else 
			echo json_encode(['status' => 0, 'errors' => ["Cart detail with id of $id cannot be found."]]);
	}
	
}