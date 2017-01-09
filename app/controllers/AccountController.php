<?php

require_once(MODEL_PATH . 'User.php');

require_once(MODEL_PATH . 'Customer.php');

require_once(MODEL_PATH . 'Order.php');

require_once(MODEL_PATH . 'OrderDetail.php');

require_once(MODEL_PATH . 'Address.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');

require_once(MODEL_PATH . 'Category.php');

require_once(MODEL_PATH . 'Image.php');

require_once(MODEL_PATH . 'Promotion.php');

class AccountController extends Controller {

	public function index() {
		
		if (!Auth::check())
			Router::redirect('login');

		$user = Auth::user();

		if ($user->isCustomer()) {
			$user->load('customer');

			if (!$user->customer)
				View::render('accounts/register.php', [
					'in_cart' => Cart::count(),
					'categories' => Category::all(),
				]);
			else {

				$order = Order::with(['address', 'order_details.product'])
									->where('customer_id', $user->customer->id)
									->orderBy('created_at', 'DESC')->first();
			
				View::render('accounts/home.php', [
					'user' => $user,
					'order' => $order,
					'in_cart' => Cart::count(),
					'categories' => Category::all(),
				]);
			}
		}
		else if ($user->isAdmin())
			Router::redirect('admin/dashboard');

	}
}