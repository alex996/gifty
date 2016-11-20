<?php

class Promotion extends Model {
	
	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $starts_at;

	public $ends_at;

	public $discount;
}

Promotion::initialize();