<?php

class Model {

	//public $id;

	protected static $class;

	protected static $table;

	protected static $excluded = ['class', 'table'];

	public function __get($name) {
		return $this->$name;
	}

	public function __set($name, $value) {
		$this->$name = $value;
	}

	public function __construct() { }

	public static function __static() {
		if (!static::$class && !static::$table) {
			static::$class = get_called_class(); // ex: User
			static::$table = strtolower(static::$class).'s'; // ex: users
		}
	}

	public static function find($id) {
		self::__static();
		return DB::table(static::$table)->where('id', $id)->get();
	}

	public static function all() {
		self::__static();
		return DB::table(static::$table)->all();
	}

	public static function create($args) {
		self::__static();
		DB::table(static::$table)->insert($args);
		// TODO: return the object????
	}

	public function save() {
		self::__static();
		print_r($this->toArray());die();
		DB::table(static::$table)->insert($this->toArray());
		// TODO: return the object????
	}




	public function toArray()
	{
	    return array_diff(get_object_vars($this), self::$excluded);

	    /*if (!is_object($obj) && !is_array($obj))
        	return $obj;

    	return array_map('toArray', (array) $obj);*/
	}

}

//Model::__static();