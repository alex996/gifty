<?php

class Category extends Model {
	
	protected static $class;

	protected static $table = 'categories';

	protected static $fillable;

	public $id;

	public $name;

	public static function id($name) {
		return Category::where('name', $name)->get()->id;
	}
}

Category::initialize();