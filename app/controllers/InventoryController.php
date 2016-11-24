<?php

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Image.php');

require_once(MODEL_PATH . 'Promotion.php');

class InventoryController {

	public function check_auth() {
		if (!Auth::check())
			Router::redirect('login');
		else if (Auth::user()->isCustomer())
			Router::redirect('account');
	}

	public function index() {

		$this->check_auth();

		View::render('inventory/index.php', [
			'products' => Product::with(['category', 'promotion'])->all(),
			'categories' => Category::all(),
		]);
	}

	public function create() {

		$this->check_auth();

		View::render('inventory/create.php', [
			'categories' => Category::all(),
		]);
	}

	public function show($id) {

		$this->check_auth();

		$product = Product::with(['category', 'images'])->find($id);

		if (!$product)
			View::render('errors/404.php', [
				'categories' => Category::all(),
			]);
		else
			View::render('inventory/details.php', [
				'product' => $product,
				'categories' => Category::all(),
			]);

		
		
	}
	
}