<?php

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Image.php');

require_once(MODEL_PATH . 'Promotion.php');

class InventoryController {

	public function index() {

		View::render('inventory/index.php', [
				'products' => Product::with(['category', 'promotion'])->all(),
				'in_cart'  => Cart::count(),
				'categories' => Category::all(),
			]);

	}
	
}