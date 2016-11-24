<?php

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Review.php');

require_once(MODEL_PATH . 'Customer.php');

class ProductController extends Controller {
	
	public function index() {

		if (!empty($_GET['search']) && !empty($_GET['filter']) && !empty($_GET['direction']))
			$products = Product::where('name', 'LIKE', "%{$_GET['search']}%")
									->orWhere('description', 'LIKE', "%{$_GET['search']}%")
									->orderBy($_GET['filter'], $_GET['direction'])
									->get();
		else if (!empty($_GET['filter']) && !empty($_GET['direction']))
			$products = Product::orderBy($_GET['filter'], $_GET['direction'])->get();
		else if (!empty($_GET['search']))
			$products = Product::where('name', 'LIKE', "%{$_GET['search']}%")
									->orWhere('description', 'LIKE', "%{$_GET['search']}%")->get();
		else
			$products = Product::all();

		if (!is_array($products) && $products) $products = [$products];

		View::render('products/index.php', [
			'products' => $products,
			'in_cart' => Cart::count(),
			'categories' => Category::all(),
		]);
	}

	public function index_category($category) {
		$category_id = Category::id($category);

		if ($category_id) {

			if (!empty($_GET['search']) && !empty($_GET['filter']) && !empty($_GET['direction']))
				$products = Product::where('category_id', $category_id)
										->andWhere('name', 'LIKE', "%{$_GET['search']}%")
										->orWhere('description', 'LIKE', "%{$_GET['search']}%")
										->orderBy($_GET['filter'], $_GET['direction'])
										->get();
			else if (!empty($_GET['filter']) && !empty($_GET['direction']))
				$products = Product::where('category_id', $category_id)
										->orderBy($_GET['filter'], $_GET['direction'])
										->get();
			else if (!empty($_GET['search']))
				$products = Product::where('category_id', $category_id)
										->andWhere('name', 'LIKE', "%{$_GET['search']}%")
										->orWhere('description', 'LIKE', "%{$_GET['search']}%")
										->get();
			else
				$products = Product::where('category_id', $category_id)->get();

			if (!is_array($products) && $products) $products = [$products];

			View::render('products/index.php', [
				'products' => $products,
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
				'category' => $category
			]);
		}
		else {
			View::render('errors/404.php', [
				'in_cart' => Cart::count(),
				'categories' => Category::all(),
			]);
		}
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
			$suggestions = Product::where('category_id', $product->category_id)
									->andWhere('id', '!=', $product->id)->random(4)->all();

			View::render('products/details.php', [
				'product' => $product,
				'suggestions' => $suggestions,
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