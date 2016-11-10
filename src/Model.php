<?php

class Model {

	protected static $class;

	protected static $table;

	public function __get($name) {
		return $this->$name;
	}

	public function __set($name, $value) {
		$this->$name = $value;
	}

	public function __construct() { }

	public static function __static() {
		static::$class = get_called_class(); // ex: User
		static::$table = strtolower(static::$class).'s'; // ex: users
	}

	public static function __callStatic($method, $args)
    {
        return call_user_func_array([DB::table(static::$table), $method], $args);
    }

    public static function first() {
    	return static::where('id', 1)->limit(1)->select();
    }

    public static function find($id) {
        return static::where('id', $id)->select();
    }

    public static function get($column, $operator = null, $value = null) {
    	return static::where($column, $operator, $value)->select();
    }

    public static function all() {
        return static::select();
    }

    public static function create($args) {
    	return static::insert($args);
    }

    public function save() {
    	if (isset($this->id)) {
    		echo "id is set to " . $this->id;
    		$obj = static::where('id', $this->id)->select();
    		
    		if (!empty($obj))
    			return static::where('id', $this->id)->update($this->toArrayStrict());
    		echo "this can't be happening... wtf";
    	}

   		static::insert($this->toArray());
	}

	public function delete() {
		static::where('id', $this->id)->delete();
	}

	public function toArray($strict=0)
	{
		$args = get_object_vars($this);
		if ($strict) {
			$args = array_diff($args, ['']);
			unset($args['id']);
		}
		return $args;
	}

	public function toArrayStrict() {
		return $this->toArray(1);
	}
}