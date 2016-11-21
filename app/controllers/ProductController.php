<?php

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

class ProductController extends Controller {
	
	public function index() {
		View::render('products/index.php', [
			'products' => Product::all(),
			'in_cart' => Cart::count()
		]);
	}

	public function index_category($category) {
		$category_id = Category::id($category);
		$products = Product::where('category_id', $category_id)->get();
		$products = is_array($products) ? $products : [$products];

		View::render('products/index.php', [
			'products' => $products,
			'in_cart' => Cart::count()
		]);
	}

	public function create() {
		
	}


	// Create a new user:
	public function store() {
		print_r($_POST);
	}

	public function show($id) {
		
	}

	public function edit() {
		
	}

	public function update() {
		print_r($_POST);
	}

	public function destroy() {
		print_r($_POST);
	}
}