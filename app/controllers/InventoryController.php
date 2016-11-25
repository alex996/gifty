<?php

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Image.php');

require_once(MODEL_PATH . 'Promotion.php');

require_once(MODEL_PATH . 'Review.php');

require_once(CTRL_PATH . 'traits/ImageTrait.php');

class InventoryController {

	use ImageTrait;

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
			'promotions' => Promotion::where('ends_at', '>', date('Y-m-d G:i:s'))->all()
		]);
	}

	public function show($id) {

		$this->check_auth();

		$product = Product::with(['category', 'promotion', 'images', 'review'])->find($id);

		if (!$product)
			View::render('errors/404.php', [
				'categories' => Category::all(),
			]);
		else
			View::render('inventory/details.php', [
				'product' => $product,
				'featured' => $product->featured_img(),
				'categories' => Category::all(),
			]);
	}

	public function store() {

		$this->check_auth();
		
		$_POST['promotion_id'] = empty($_POST['promotion_id']) ? null : $_POST['promotion_id'];

		$errors = Validator::validate($_POST, [
			'name' => 'required|max:255',
			'description' => 'required',
			'category_id' => 'required|digits|minval:1',
			'price' => 'required|numeric|minval:0|maxval:999999.99',
			'promotion_id' => 'sometimes|digits|minval:1',
			'quantity' => 'required|digits|minval:0|maxval:99999',
			'status' => 'required|in:'.Product::IN_STOCK.','
							.Product::OUT_OF_STOCK,
			'featured' => 'required|in:0,1'
		]);

		$successes = [];

		if (empty($errors)) {

			$product = Product::create([
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				'category_id' => $_POST['category_id'],
				'price' => $_POST['price'],
				'promotion_id' => $_POST['promotion_id'],
				'quantity' => $_POST['quantity'],
				'status' => $_POST['status'],
				'featured' => $_POST['featured']
 			]);

 			if ($product) {

 				// Upload images
 				$total = count($_FILES['img']['name']);
 				for($i = 0; $i < $total; $i++) {
 					// Check if an image was uploaded using the form
	 				if(file_exists($_FILES['img']['tmp_name'][$i]) && is_uploaded_file($_FILES['img']['tmp_name'][$i])) {

	 					// Upload the image
		 				$res = ImageTrait::upload($_FILES["img"], $i, $product->category()->name);

		 				if ($res['status'] == 1) {

		 					$path = $res['path'];

		 					// Upload successful
		 					Image::create([
								"product_id" => $product->id,
								"path" => $path,
								"alt_text" => $_POST['alt_text'][$i],
								"featured" => empty($_POST['featured_img'][$i]) ? 0 : 1
		 					]);
		 					$successes[] = "Product with id {$product->id} created. Image uploaded to $path";
		 				} else {
		 					$successes[] = "Product with id {$product->id} created. No image was uploaded.";
		 					if (empty($errors))
		 						$errors = $res['errors'];
		 					else
		 						$errors[] = array_merge($errors, $res['errors']);
		 				}
	 				}
 				}

 				if (empty($successes))
 					$successes[] = "Product created with id {$product->id}. No image was uploaded.";

 			} else
 				$errors[] = 'Product was not created.';
		}
print_r($errors);die();
		View::render('inventory/create.php', [
			'categories' => Category::all(),
			'promotions' => Promotion::where('ends_at', '>', date('Y-m-d G:i:s'))->all(),
			'successes' => $successes,
			'errors' => $errors,
		]);
	}

	public function edit($id) {
		$this->check_auth();

		$product = Product::with(['category', 'images', 'promotion'])->find($id);

		if (!$product)
			View::render('errors/404.php', [
				'categories' => Category::all(),
			]);
		else
			View::render('inventory/edit.php', [
				'product' => $product,
				'categories' => Category::all(),
				'promotions' => Promotion::where('ends_at', '>', date('Y-m-d G:i:s'))->all()
			]);
	}

	public function update($id) {
		$this->check_auth();

		$product = Product::with(['category', 'images'])->find($id);

		if (!$product)
			View::render('errors/404.php', [
				'categories' => Category::all(),
			]);
		else {

			$errors = Validator::validate($_POST, [
				'name' => 'sometimes|max:255',
				'description' => 'sometimes',
				'category_id' => 'sometimes|digits|minval:1',
				'price' => 'sometimes|numeric|minval:0|maxval:999999.99',
				'promotion_id' => 'sometimes|digits|minval:1',
				'quantity' => 'sometimes|digits|minval:0|maxval:99999',
				'status' => 'sometimes|in:'.Product::IN_STOCK.','
								.Product::OUT_OF_STOCK,
				'featured' => 'sometimes|in:0,1'
			]);

			if (empty($errors)) {
				// Product-specific validation logic
				$end_of_life = $product->status == Product::END_OF_LIFE;
				if ($end_of_life && !empty($_POST['promotion_id']))
					$errors[] = 'Cannot set a promotion on a product with the status of '.Product::END_OF_LIFE.".";
				else if ($end_of_life && !empty($_POST['promotion_id']))
					$errors[] = 'Cannot make a product with the status of '.Product::END_OF_LIFE.' featured on the homepage.';
				else {

					if (!empty($_POST['END_OF_LIFE'])) {
						$_POST['promotion_id'] = null;
						$_POST['featured'] = 0;
					}

					if (!empty($_POST['name']))
						$product->name = $_POST['name'];
					if (!empty($_POST['description']))
						$product->name = $_POST['description'];
					if (!empty($_POST['category_id']))
						$product->name = $_POST['category_id'];
					if (!empty($_POST['price']))
						$product->name = $_POST['price'];
					if (!empty($_POST['promotion_id']))
						$product->name = $_POST['promotion_id'];
					if (!empty($_POST['quantity']))
						$product->name = $_POST['quantity'];
					if (!empty($_POST['status']))
						$product->name = $_POST['status'];
					if (!empty($_POST['status']))
						$product->name = $_POST['status'];
					if (!empty($_POST['featured']))
						$product->name = $_POST['featured'];
					$product->save();

					View::render('inventory/edit.php', [
						'product' => $product,
						'categories' => Category::all(),
						'promotions' => Promotion::where('ends_at', '>', date('Y-m-d G:i:s'))->all(),
						'success' => 'Product updated.',
					]);

				}
			}
		}

		View::render('inventory/edit.php', [
			'product' => $product,
			'categories' => Category::all(),
			'promotions' => Promotion::where('ends_at', '>', date('Y-m-d G:i:s'))->all(),
			'errors' => $errors,
		]);
	}

	public function destroy($id) {
		$this->check_auth();

		$product = Product::with(['category', 'images'])->find($id);

		if (!$product)
			View::render('errors/404.php', [
				'categories' => Category::all(),
			]);
		else {

			$product->status = "END_OF_LIFE";
			$product->save();

			View::render('inventory/index.php', [
				'products' => Product::with(['category', 'promotion'])->all(),
				'categories' => Category::all(),
				'success' => 'Status of product with ID of '.$product->id.' was set to '.Product::END_OF_LIFE.'.'
			]);
		}
	}
	
}