<?php

class Promotion extends Model {
	
	protected static $class;

	protected static $table;

	protected static $fillable;

	public $id;

	public $starts_at;

	public $ends_at;

	public $discount;

	public function active() {
		return $this->ends_at > date('Y-m-d H:i:s');
	}
}

Promotion::initialize();