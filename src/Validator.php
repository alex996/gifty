<?php
//https://github.com/illuminate/validation/blob/master/Validator.php
class Validator {

	private static function required($data) {
		if (is_null($value))
            return false;
        else if (is_string($value) && trim($value) === '')
            return false;
		else
			return true;
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