<?php

class Category extends Model {
	
	protected static $class;

	protected static $table = 'categories';

	protected static $fillable;

	public $id;

	public $name;
}

Category::initialize();