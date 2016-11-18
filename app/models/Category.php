<?php

class Category extends Model {
	
	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $name;
}

Category::initialize();