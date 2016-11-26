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

	const IN_STOCK = 'IN_STOCK';

	const OUT_OF_STOCK = 'OUT_OF_STOCK';

	const END_OF_LIFE = 'END_OF_LIFE';

	public function reviews() {
		return $this->hasMany('Review');
	}

	public function category() {
		return $this->belongsTo('Category');
	}

	public function promotion() {
		return $this->hasOne('Promotion');
	}

	public function images() {
		return $this->hasMany('Image');
	}

	public function featured_img() {
		return Image::where('product_id', $this->id)
					->andWhere('featured', 1)->first();
	}

	public function rating() {
		$reviews = $this->reviews();
		$count = count($reviews);
		$ratings_sum = 0;

		foreach($reviews as $review)
			$ratings_sum += $review->rating;

		return ($count > 0) ? $ratings_sum / count($reviews) : 0;
	}

	public function status() {
		return ucwords(strtolower(str_replace('_', ' ', $this->status)));
	}

	public static function on_sale($lim = 3) {
		$promotions = Promotion::where('ends_at', '>', date('Y-m-d H:i:s'))->all();
		$ids = [];
		foreach($promotions as $promo)
			$ids[] = $promo->id;
		return Product::with('promotion')->where('featured', 1)
	                       ->andWHere('status', Product::IN_STOCK)
	                       ->andWhereIn('promotion_id', $ids)
	                       ->random($lim)
	                       ->all();
	}

	public function price_with_promotion() {
		$promo = $this->promotion();
		if ($promo)
			return $this->price - ($this->price * $promo->discount);
		else
			return $this->price;
	}

	/*public function __construct() {

		$reviews = $this->load('review');
		$this->reviews = count($reviews);
		$this->rating = Review::where('product_id', $this->id)->select('AVG(rating)');


	}*/
}

Product::initialize();