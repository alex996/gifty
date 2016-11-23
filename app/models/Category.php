<?php

class Category extends Model {
	
	protected static $class;

	protected static $table = 'categories';

	protected static $fillable;

	public $id;

	public $name;

	public static function id($name) {
		$category = Category::where('name', $name)->select('id');
		return $category ? $category->id : null;
	}
}

Category::initialize();