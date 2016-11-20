<?php

require_once(MODEL_PATH . 'Product.php');

class HomeController {

	public function index() {

		View::render('welcome.php', [
			'products' => Product::random(8)->with('reviews')->get()
		]);

	}

}