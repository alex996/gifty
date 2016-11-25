<?php

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Image.php');

class HomeController {

	public function index() {
		// TODO: when we add more products to the db,
		// and andWhere('featured', 1) to the $products below
		View::render('welcome.php', [
			'products' => Product::where('featured', 1)->random(8)->get(),
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
		]);
	}

	public function fallback() {
		View::render('errors/404.php', ['in_cart' => Cart::count(), 'categories' => Category::all()]);
	}

}