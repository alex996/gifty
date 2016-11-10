<?php

class Validator {

	private static function required($data) {
		return !empty($data);
	}

	private static function digits($data) {
		return ctype_digit($data);
	}

	private static function integer($data) {
		//pos or neg
	}

	private static function numeric($data) {
		return is_numeric($data);
	}

	private static function alphanumeric($data) {
		return ctype_alnum($data);
	}

	private static function max($data, $max) {
		return $data <= $max;
	}

	private static function min($data, $min) {
		return $data >= $max;
	}

	private static function date($data) {
		return /*(bool)*/strtotime($data);
	}
}