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


    public function __get($name) {
    	return isset($this->$name) ? $this->$name : null;
    }

	/*public function __set($name, $value) {
        if (isset($this->$name))
        	$this->$name = $value;
    }*/

	/**
	 * Forwards invocations of non-existing
	 * static methods to the DB class, allowing
	 * each model to fully utilize DB API.
	 */
	public static function __callStatic($method, $args)
    {
    	//return DB::table(static::$table)->$method(...$args); // splat operator requires php 5.6+
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
		// Register class and table names in ModelResolver
		ModelResolver::register(static::$class, static::$table);
	}

	/**
	 * Performs a safe insert on a model class.
	 */
	public static function create($args) {
		$data = [];
		// Check that arugments contain all fillables,
		// otherwise a record cannot be inserted
		foreach (static::$fillable as $index => $field)
			// Build a safe array with fillables, ignoring
			// any non-fillable arguments
			$data[$field] = (array_key_exists($field, $args)) ? $args[$field] : null;
		
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
    			$data = $this->toArray();
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
	 * Loads the related object(s).
	 */
    /*public function load($rel, $fk = null) {
    	$relationships = is_array($rel) ? $rel : [$rel];
    	foreach($relationships as $rel) {
    		if ($rel) {
    			$rel_arr = explode("_", $rel);
    			$rel_class = ucfirst($rel_arr[0]) . ucfirst( isset($rel_arr[1]) ? $rel_arr[1] : "" );
	        	// = ucfirst($rel);

	        	// FK on this object --> hasOne or hasMany
	            $fk_column = $fk ? $fk : strtolower($rel).'_id';

	            if (isset($this->$fk_column)) {
	            	$this->$rel = $rel_class::find($this->$fk_column);
	            } else {
	            	// FK on rel object --> belongsToOne or belongsToMany
	            	$fk_column = $fk ? $fk : strtolower(static::$class).'_id';
	            	$this->$rel = $rel_class::where($fk_column, $this->id)->get();
	            }
	        }
    	}
    }*/

   
    /****************** RELATIONSHIPS ******************/

    public function load($relationship) {
    	$this->$relationship = $this->$relationship();
    	return $this;
    }

    /*$this is PaymentMethod
    	$this->hasOne('Address');*/
    public function hasOne($class, $foreign_key = null) {
		/*// Foreign key in the $class model
		$foreign_key = ($foreign_key) ? $foreign_key : strtolower(static::$class).'_id';
		return $class::where($foreign_key, $this->id)->get();*/

		// Foreign key in $this model
    	$foreign_key = ($foreign_key) ? $foreign_key : strtolower($class).'_id';
    	return $class::find($this->$foreign_key);
    }

    /*$this is Product
    	$this->hasMany('Review');*/
    public function hasMany($class, $foreign_key = null) {
		// Foreign key in the $class model
		$foreign_key = ($foreign_key) ? $foreign_key : strtolower(static::$class).'_id';

		$rel = $class::where($foreign_key, $this->id)->get();
		
		if (is_array($rel))
			return $rel;
		else if (is_null($rel))
			return [];
		else
			return [$rel];
    }

    /*$this is OrderDetail
    	$this->belongsTo('Order');*/
    public function belongsTo($class, $foreign_key = null) {
    	// Foreign key in $this model
    	$foreign_key = ($foreign_key) ? $foreign_key : strtolower($class).'_id';
    	return $class::find($this->$foreign_key);
    }

    /*$this is Address
    	$this->belongsTo('PaymentMethod');*/
    public function belongsToMany($class, $foreign_key = null) {
    	// Foreign key in the $class model
    	$foreign_key = ($foreign_key) ? $foreign_key : strtolower(static::$class).'_id';

    	$rel = $class::where($foreign_key, $this->id)->get();
    	
    	if (is_array($rel))
			return $rel;
		else if (is_null($rel))
			return [];
		else
			return [$rel];
    }

	/**
	 * Converts a model instance into an assoc array,
	 * containing any dynamically created properties.
	 */
	public function toArray() {
		return get_object_vars($this);
	}
}