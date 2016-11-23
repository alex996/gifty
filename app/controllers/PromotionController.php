<?php

require_once(MODEL_PATH . 'Promotion.php');

require_once(MODEL_PATH . 'Cart.php');

require_once(MODEL_PATH . 'CartDetail.php');

require_once(MODEL_PATH . 'Product.php');


class PromotionController extends Controller {

	/*public $shared = [];

	public function shared() {
		if (empty($this->shared))
			$this->shared = [
				
				
			];
		return $this->shared;
	}
*/
	public function check_auth() {
		if (!Auth::check())
			Router::redirect('login');
		else if (Auth::user()->isCustomer())
			Router::redirect('account');
	}

	public function index() {

		$this->check_auth();

		View::render('promotions/index.php', [
			'in_cart' => 0,
			'promotions' => Promotion::all(),
		]);
	}

	public function edit($id) {

		$this->check_auth();

		$promotion = Promotion::find($id);

		if ($promotion)
			View::render('promotions/edit.php', [
				'in_cart' => 0,
				'promotion' => $promotion,
			]);
		else
			View::render('errors/404.php', [
				'in_cart' => 0
			]);
	}

	public function create() {
		$this->check_auth();
		View::render('promotions/create.php', [
			'in_cart' => 0,
		]);
	}

	public function store() {

		// date('Y-m-d G:i:s')

	}

	public function update($id) {
		$this->check_auth();

		$promotion = Promotion::find($id);

		if ($promotion)
			View::render('promotions/edit.php', [
				'in_cart' => 0,
				'promotion' => $promotion,
				'errors' => 'Promotion with id of $id not found.'
			]);
		else
			View::render('errors/404.php', [
				'in_cart' => 0
			]);
	}

	public function delete($id) {
		
	}

}