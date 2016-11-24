<?php

require_once(MODEL_PATH . 'Category.php');

class DashboardController extends Controller {

	public function index() {
		
		if (!Auth::check())
			Router::redirect('login');
		else if (Auth::user()->isCustomer())
			Router::redirect('account');

		$user = Auth::user();

		View::render('admin/dashboard.php', [
			'user' => $user,
			'in_cart' => 0,
			'categories' => Category::all(),
		]);
	}

}