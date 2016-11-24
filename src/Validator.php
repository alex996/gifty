<?php
//https://github.com/illuminate/validation/blob/master/Validator.php
class Validator {

	/*public $errors;

	public static function make($data, $rules) {
		$validator = new self();

		foreach($rules as $key => $rules) {
    		$checks = explode("|", $rules);
    		foreach($checks as $check) {
    			
    			$components = explode(":", $check);
    			$method = $components[0];
    			$arg = isset($components[1]) ? $components[1] : null;

    			if (!isset($data[$key]) || !self::$method($data[$key], $arg))
    				$validator->errors[$key] = self::message($method, $key, $arg);
    		}
    	}

		return $validator;
	}

	public function succeeded() {
		return empty($this->errors);
	}

	public function failed() {
		return !empty($this->errors);
	}*/

    public static function validate($data, $rules) {
    	$errors = [];
    	foreach($rules as $key => $rules) {
    		$checks = explode("|", $rules);
    		foreach($checks as $check) {
    			//echo $check;die();

                $components = explode(":", $check, 2); // 2 elements max
    			$method = $components[0];
    			$arg = isset($components[1]) ? $components[1] : null;

    			if (!isset($data[$key]) || !self::$method($data[$key], $arg))
    				$errors[] = self::message($method, $key, $arg);
    		}
    	}
    	return $errors;
    }

    private static function message($method, $key, $arg='') {
    	$field = ucfirst(str_replace('_', ' ', $key));
    	switch ($method) {
    		case "required":
    			return "$field is required."; break;
    		case "min":
    			return "$field must be at least $arg characters long."; break;
    		case "max":
    			return "$field must be at most $arg characters long."; break;
    		case "email":
    			return "$field must be in format example@domain.com."; break;
            case "unique":
                return "$field already exists."; break;
            case "after":
                return "$field must be a date after $arg.";
            case "before":
                return "$field must be a date before $arg.";
    		default:
    			return "$field is invalid.";
    	}
    }

	private static function required($value) {
		if (is_null($value))
            return false;
        else if (is_string($value) && trim($value) === '')
            return false;
		else
			return true;
	}

	private static function digits($value) {
		return ctype_digit($value);
	}

	private static function integer($value) {
		return filter_var($value, FILTER_VALIDATE_INT);
	}

	private static function numeric($value) {
		return is_numeric($value);
	}

	private static function alphanumeric($value) {
		return ctype_alnum($value);
	}

    private static function alphanum_dash($value) {
        return ctype_alnum(str_replace('-', '', $value));
    }

    private static function size($value, $size) {
        return strlen($value) == $size;
    }

	private static function max($value, $max) {
        $value = is_numeric($value) ? $value : strlen($value);
		return $value <= $max;
	}

	private static function min($value, $min) {
        $value = is_numeric($value) ? $value : strlen($value);
		return $value >= $min;
	}

	private static function date($value) {
		return /*(bool)*/strtotime($value);
	}

	private static function email($value) {
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

    private static function phone($value) {
        //https://ericholmes.ca/php-phone-number-validation-revisited/
        return preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $value);
    }

    private static function in($value, $list) {
        $list = explode(",", $list);
        return in_array($value, $list);
    }

    private static function exists($value, $list) {
        list($table, $column) = explode(",", $list);
        $obj = DB::table($table)->where($column, $value)->select($column);
        return isset($obj->$column);
    }

    private static function unique($value, $list) {
        return ! self::exists($value, $list);
    }

    private static function same($value, $other) {
        return $value == $other;
    }

    private static function before($value, $other) {
        switch ($other) {
            case 'now': $other = date('Y-m-d G:i:s'); break;
            //case 'tomorrow': $other = ... // continue if needed
            default: $other = date('Y-m-d G:i:s', strtotime($other)); break;
        }
        $value = date('Y-m-d G:i:s', strtotime($value)); // GMT
        return $value < $other;
    }

    private static function after($value, $other) {
        switch ($other) {
            case 'now': $other = date('Y-m-d G:i:s'); break;
            //case 'tomorrow': $other = ... // continue if needed
            default: $other = date('Y-m-d G:i:s', strtotime($other)); break;
        }
        $value = date('Y-m-d G:i:s', strtotime($value)); // GMT
        return $value > $other;
    }

    public static function user_password($value) {
        return Auth::matches($value);
    }
}