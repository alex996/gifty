<?php

class Review extends Model {

	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $customer_id;

	public $product_id;

	public $comment;

	public $rating;

	public $created_at;

}

Review::initialize();