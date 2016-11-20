<?php

class ModelResolver {

	public static $class_table = [];

	public static function getClass($table) {
		return array_search($table, self::$class_table);
	}

	public static function getTable($class) {
		return self::$class_table[$class];
	}

	public static function register($class, $table) {
		self::$class_table[$class] = $table;
	}

}