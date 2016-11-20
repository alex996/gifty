<?php

require_once(MODEL_PATH . 'Review.php');

class Product extends Model {

	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $name;

	public $description;

	public $category_id;

	public $price;

	public $promotion_id;

	public $quantity;

	public $status;

	public $featured;

<<<<<<< HEAD
	const IN_STOCK = 'IN_STOCK';

	const OUT_OF_STOCK = 'OUT_OF_STOCK';

	const END_OF_LIFE = 'END_OF_LIFE';

=======
>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2
	public function reviews() {
		return $this->hasMany('Review');
	}

	public function category() {
		return $this->belongsTo('Category');
	}

	public function promotion() {
		return $this->hasOne('Promotion');
	}

	/*public function __construct() {

		$reviews = $this->load('review');
		$this->reviews = count($reviews);
		$this->rating = Review::where('product_id', $this->id)->select('AVG(rating)');


	}*/
}

Product::initialize();