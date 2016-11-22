<?php

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Review.php');

class ProductController extends Controller {
	
	public function index() {
		View::render('products/index.php', [
			'products' => Product::all(),
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
		]);
	}

	public function index_category($category) {
		$category_id = Category::id($category);
		$products = Product::where('category_id', $category_id)->get();
		$products = is_array($products) ? $products : [$products];

		View::render('products/index.php', [
			'products' => $products,
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
		]);
	}

	// Create a new user:
	public function store() {
		print_r($_POST);
	}

	public function show($id) {
		$product = Product::with(['category','reviews'])->find($id);

		if (empty($product)) {
			View::render('errors/404.php', [
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
		} else {
			View::render('products/details.php', [
				'product' => $product,
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
		}
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