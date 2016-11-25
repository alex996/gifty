<?php

require_once(MODEL_PATH . 'Order.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Address.php');

require_once(MODEL_PATH . 'PaymentMethod.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'OrderDetail.php');

require_once(MODEL_PATH . 'Image.php');

require_once(MODEL_PATH . 'Promotion.php');

class SalesController {


	public function check_auth() {
		if (!Auth::check())
			Router::redirect('login');
		else if (Auth::user()->isCustomer())
			Router::redirect('account');
	}

	public function index() {
		$this->check_auth();

		View::render('sales/index.php', [
			'sales' => Order::all(),
			'categories' => Category::all(),
		]);
	}

	public function show($id) {
		$sale = Order::with(['order_details.product', 'address'])->where('id', $id)->get();

		if ($sale) {
			View::render('sales/details.php', [
				'sale' => $sale,
				'categories' => Category::all(),
			]);
		} else {
			View::render('errors/404.php', [
				'categories' => Category::all(),
			]);
		}
	}

	public function update_status($id){
		$sale = Order::where('id', $id)->get();

		if ($sale) {
			$statuses = implode(',', [
				Order::PENDING,
				Order::APPROVED,
				Order::DELIVERED,
				Order::CANCELLED,
				Order::ERROR
			]);

			$errors = Validator::validate($_POST, [
				'status' => "required|in:$statuses"
			]);

			if (empty($errors)) {
				$sale->status = $_POST['status'];
				$sale->save();

				View::render('sales/index.php', [
					'sales' => Order::all(),
					'categories' => Category::all(),
					'success' => 'Status updated.'
				]);
			} else {
				View::render('sales/index.php', [
					'sales' => Order::all(),
					'categories' => Category::all(),
					'error' => reset($errors),
				]);
			}

			
		} else {
			View::render('errors/404.php', [
				'categories' => Category::all(),
			]);
		}
	}

}