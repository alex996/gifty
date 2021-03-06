<?php

require_once(MODEL_PATH . 'Promotion.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');


class PromotionController extends Controller {

	public function check_auth() {
		if (!Auth::check())
			Router::redirect('login');
		else if (Auth::user()->isCustomer())
			Router::redirect('account');
	}

	public function index() {

		$this->check_auth();

		View::render('promotions/index.php', [
			'promotions' => Promotion::orderBy('ends_at', 'DESC')->all(),
			'categories' => Category::all(),
		]);
	}

	public function edit($id) {

		$this->check_auth();

		$promotion = Promotion::find($id);

		if ($promotion)
			View::render('promotions/edit.php', [
				'promotion' => $promotion,
				'categories' => Category::all(),
			]);
		else
			View::render('errors/404.php', [
				'categories' => Category::all(),
			]);
	}

	public function create() {
		$this->check_auth();
		View::render('promotions/create.php', [
			'categories' => Category::all(),
		]);
	}

	public function store() {

		$this->check_auth();

		$errors = Validator::validate($_POST, [
			'discount' => 'required|minval:0|maxval:0.99',
			'starts_at' =>'required|date',
			'ends_at' =>'required|date|after:now|after:'.$_POST['starts_at'],
		]);

		if (!empty($errors))
			View::render('promotions/create.php', [
				'errors' => $errors,
				'categories' => Category::all(),
			]);
		else {
			Promotion::create([
				'discount' => $_POST['discount'],
				"starts_at" => date('Y-m-d G:i:s', strtotime($_POST['starts_at'])),
				"ends_at"   => date('Y-m-d G:i:s', strtotime($_POST['ends_at'])),
			]);

			View::render('promotions/index.php', [
				'promotions' => Promotion::orderBy('ends_at', 'DESC')->all(),
				'categories' => Category::all(),
				'success' => 'Promotion launched.'
			]);
		}

	}

	public function update($id) {

		$this->check_auth();

		$promotion = Promotion::find($id);

		if ($promotion) {

			$errors = Validator::validate($_POST, [
				'discount' => 'required|minval:0|maxval:0.99',
				'starts_at' =>'required|date',
				'ends_at' =>'required|date|after:now|after:'.$_POST['starts_at'],
			]);

			if (!empty($errors))
				View::render('promotions/edit.php', [
					'errors' => $errors,
					'promotion' => $promotion,
					'categories' => Category::all(),
				]);
			else {
				$promotion->discount = $_POST['discount'];
				$promotion->starts_at = date('Y-m-d G:i:s', strtotime($_POST['starts_at'])); // SQL timestamp
				$promotion->ends_at = date('Y-m-d G:i:s', strtotime($_POST['ends_at'])); // SQL timestamp
				$promotion->save();

				View::render('promotions/edit.php', [
					'promotion' => $promotion,
					'success' => 'Promotion updated.',
					'categories' => Category::all(),
				]);
			}
		}
			
		else
			View::render('errors/404.php', [
				'errors' => ['Promotion with id of $id not found.'],
				'categories' => Category::all(),
			]);
	}

	public function destroy($id) {
		$this->check_auth();

		$promotion = Promotion::find($id);

		if ($promotion) {

			$products = Product::where('promotion_id', $id)->all();

			//Changing all products' promotion_id of the specified promotion to null
			foreach ($products as $product) {
				$product->promotion_id = null;
				$product->save();
			}

			$promotion->delete();

			View::render('promotions/index.php', [
				'promotions' => Promotion::orderBy('ends_at', 'DESC')->all(),
				'categories' => Category::all(),
				'success' => 'Promotion deleted.'
			]);

		} else
			View::render('errors/404.php', [
				'errors' => ['Promotion with id of $id not found.'],
				'categories' => Category::all(),
			]);

	}

}