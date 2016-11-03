<?php

class Model {

	protected $id;

	public function __set($name, $value) {}

	public function __construct() { }

	public function toArray($obj)
	{
	    if (!is_object($obj) && !is_array($obj))
        	return $obj;

    	return array_map('toArray', (array) $obj);
	}

}