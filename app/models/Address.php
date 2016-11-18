<?php

class Address extends Model {

	protected static $class;

	protected static $table = "addresses";

	protected static $fillable;

	public $id;

	public $street;

	public $city;

	public $state;

	public $country;

	public $zip;
}

Address::initialize();