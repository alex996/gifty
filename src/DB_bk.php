<?php

///////////////////////// old DB \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
public static function select($table, $columns='*', $cond=[]) {
    $columns = (is_array($columns)) ? implode(', ', $columns) : $columns;
    return self::run("SELECT $columns FROM $table");
}

public static function insert($table, $columns, $values) {
    $placeholders = ':'.implode(', :', $columns);
    $columns = implode(', ', $columns);

    self::run("INSERT INTO $table ($columns) VALUES ($placeholders)", $values);
}


/////////////////////// old model \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

public static function create($args) {
	
	//Get all class vars: 
	//$fields = array_keys(get_class_vars($class));

	$class = get_called_class();

	$table = strtolower($class).'s'; // ex: User -> users
	$columns = array_keys($args);
	$values = array_values($args);
	
	DB::insert($table, $columns, $values);
}

/**
 * Find
 * @param type $id 
 * @return type
 */
public static function find($id) {
	$class = get_called_class();

	$table = strtolower($class).'s'; // ex: User -> users

	DB::select($table)->where('id', $id);
}

public static function all() {
	$class = get_called_class();

	$table = strtolower($class).'s'; // ex: User -> users

	return DB::select($table)->fetchAll(PDO::FETCH_CLASS, $class);
}