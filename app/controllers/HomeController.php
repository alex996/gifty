<?php

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

class HomeController {

	public function index() {

		View::render('welcome.php', [
			'products' => Product::random(8)->get(),
			'in_cart' => Cart::count()
		]);

	}

}