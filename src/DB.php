<?php

class DB {
	
	protected static $instance = null;

    protected $query;

    protected $params = [];

    protected function __construct() {}

    protected function __clone() {}

    public static function instance()
    {
        if (self::$instance === null)
        {
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS, // FETCH_CLASS
                PDO::ATTR_EMULATE_PREPARES   => FALSE,
            );
            $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHAR;
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public static function table($table) {
        $db = new DB();
        $db->query = "$table ";
        return $db;
    }

    // Builds a WHERE clause
    public function where($column, $operator = null, $value = null) {
        if (func_num_args() == 2) {
            $value = $operator;
            $operator = '=';
        }
        // If a where clause is present, append to it:
        $this->query .= (strpos($this->query, 'WHERE') !== false) ? "AND " : "WHERE ";
        $this->query .= "$column $operator :$column ";
        $this->params[$column] = $value;
        return $this;
    }

    // Builds an ORDER BY clause
    public function orderby($column, $direction='') {
        if (is_array($column))
            $column = implode(', ', $column);
        $this->query .= "ORDER BY $column $direction";
        return $this;
    }

    // SELECTs a single records into an object
    public function get() {
        $this->query = "SELECT * FROM {$this->query}";
        return self::run($this->query, $this->params)->fetchObject('User');
    }

    // SELECTs all records into an array of objects
    public function all() {
        $this->query = "SELECT * FROM {$this->query}";
        return self::run($this->query, $this->params)->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    // INSERTs a record with given arguments
    public function insert($args) {
        $fields = array_keys($args);
        $columns = $columns = implode(', ', $fields);
        $placeholders = ':'.implode(', :', $fields);

        $this->query = "INSERT INTO {$this->query} ($columns) VALUES ($placeholders)";
        $this->params = $args;

        self::run($this->query, $this->params);
    }

    // UPDATEs a record, specified in the WHERE clause, with given arguments
    public function update($args) {
        $fields = array_keys($args); // array keys

        // Split the query into two components at first space:
        $components = explode(' ', $this->query, 2);
        $table = $components[0];
        $where = $components[1];

        // Build an array containing ex: 'name = :name', and then
        // implode each element with a coma:
        $placeholders = implode(', ', array_map(function($field) {
            return "$field = :$field";
        }, $fields));

        $this->query = "UPDATE $table SET $placeholders $where";
        $this->params = array_merge($this->params, $args);

        self::run($this->query, $this->params);
    }

    // DELETEs a record specified in the WHERE clause
    public function delete() {
        $this->query = "DELETE FROM {$this->query}";
        self::run($this->query, $this->params);
    }
}