<?php

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Review.php');

require_once(MODEL_PATH . 'Customer.php');

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
		$product = Product::with(['category','reviews.customer'])->find($id);

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

	public function store_review($product_id) {
		$product = Product::find($product_id);
		if ($product) {
			$errors = Validator::validate($_POST, [
				'comment' => 'required',
				'rating' => 'required|min:1|max:5'
			]);

			if (empty($errors)) {
				Review::create([
					'customer_id' => Customer::current()->id,
					'product_id' => $product_id,
					'comment' => $_POST['comment'],
					'rating' => $_POST['rating'],
					'created_at' => date("Y-m-d H:i:s"),
				]);
			}
		}

		Router::redirect_bacK();
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