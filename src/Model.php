<?php

class Model {

	/**
	 * Class name of the extended model.
	 */
	protected static $class;

	/**
	 * Table name of the extended model.
	 * Can be overwritten in a child class.
	 */
	protected static $table;

	/**
	 * Array of model properties that are
	 * allowed for an isert or an update.
	 * Can be overwritten in a child class.
	 */
	protected static $fillable;

	/**
	 * Empty constructor.
	 */
	public function __construct() { }

	/**
	 * Forwards invocations of non-existing
	 * static methods to the DB class, allowing
	 * each model to fully utilize DB API.
	 */
	public static function __callStatic($method, $args)
    {
        return call_user_func_array([DB::table(static::$table), $method], $args);
    }

    /**
     * Static class initializer. Sets class name,
     * table name, and fillables.
     */ 
    public static function initialize() {
    	// Initialize the class name of the model
		static::$class = get_called_class();
		// If the model does not define a table name,
		// default to a lowercase class name with an 's'
		if (empty(static::$table))
			static::$table = strtolower(static::$class).'s';
		// If the model does not define fillable fields,
		// default to non-excluded properties without id
		if (empty(static::$fillable)) {
			// Get all static and non-static properties
			$class_vars = get_class_vars(static::$class);
			// Make all non-excluded properties fillable
			foreach($class_vars as $property => $value)
				if (!in_array($property, ['class', 'table', 'fillable', 'id']))
					static::$fillable[] = $property;
		}
	}

	/**
	 * Performs a safe insert on a model class.
	 */
	public static function create($args) {
		$data = [];
		// Check that arugments contain all fillables,
		// otherwise a record cannot be inserted
		foreach (static::$fillable as $index => $field) {
			if (!isset($args[$field]))
				return null;
			// Build a safe array with fillables, ignoring
			// any non-fillable arguments
			$data[$field] = $args[$field];
		}
        return static::insert($data);
    }

    /**
     * Performs a safe update of a model instance.
     */
    public function save() {
    	if (isset($this->id)) {
    		// Try to find the object by its id
    		$obj = static::find($this->id);
    		
    		// If the object exists, filter its data
    		if (!empty($obj)) {
    			// Remove empty values from object data
    			$data = array_diff($this->toArray(), ['']);
    			// Remove non-fillable values from array
    			foreach($data as $prop => $value)
    				if (!in_array($prop, static::$fillable))
    					unset($data[$prop]);
    			// Check that data contains at least one fillable,
    			// otherwise there is nothing to update
    			if (empty($data))
    				return;
    			// Update
    			return static::where('id', $this->id)->update($data);
    		}
    	}
    	// Object was not found, so we will try inserting
   		return self::create($this->toArray());
	}

	/**
	 * Performs a safe delete of a model instance.
	 */
	public function delete() {
		if (isset($this->id))
			static::where('id', $this->id)->delete();
	}

	/**
	 * Converts a model instance into an assoc array,
	 * containing any dynamically created properties.
	 */
	public function toArray() {
		return get_object_vars($this);
	}
}