<?php

class Image extends Model {

	protected static $class;

	protected static $table = "addresses";

	protected static $fillable;

	public $id;

	public $product_id;

	public $path;

	public $alt_text;

	public $featured;
}

Image::initialize();