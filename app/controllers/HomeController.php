<?php

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Image.php');

require_once(MODEL_PATH . 'Promotion.php');

class HomeController {

	public function index() {
		View::render('welcome.php', [
			'products' => Product::where('featured', 1)
                                   ->andWHere('status', Product::IN_STOCK)
			                       ->random(8)->get(),
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
			'on_sale' => Product::on_sale(3),
			'random_categories' => Category::random(4)->get(),
		]);
	}

	public function fallback() {
		View::render('errors/404.php', ['in_cart' => Cart::count(), 'categories' => Category::all()]);
	}

}