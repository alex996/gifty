<?php

class DB {

    private $class;

    private $query;

    private $params = [];

    private $rel;

    private function __construct() {}

    public static function __callStatic($method, $args)
    {
        return call_user_func_array([Connection::instance(), $method], $args);
    }

    /*===================== Core database operations =====================*/
    /*====================================================================*/

    private static function run($sql, $args = [])
    {
        $stmt = Connection::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public static function table($table) {
        $db = new DB();
        if ($table == 'addresses')
            $db->class = "Address";
        else {
            $table_arr = explode("_", trim($table));
            $db->class = substr( ucfirst($table_arr[0]) . ucfirst( isset($table_arr[1]) ? $table_arr[1] : "" ), 0, -1);
        }
        //$db->class = ucfirst(substr(trim($table),0,-1));
        $db->query = "$table ";
        return $db;
    }

    // Builds a WHERE clause
    public function where($column, $operator = null, $value = null, $keyword = null) {
        if (!$value) {
            $value = $operator;
            $operator = '=';
        }
        
        $this->query .= ($keyword == 'AND' || $keyword == 'OR') ? "$keyword " : "WHERE ";
        $this->query .= "$column $operator :$column ";
        $this->params[$column] = $value;
        return $this;
    }

    public function andWhere($column, $operator = null, $value = null) {
        return $this->where($column, $operator, $value, 'AND');
    }

    public function orWhere($column, $operator = null, $value = null) {
        return $this->where($column, $operator, $value, 'OR');
    }

    // Builds an ORDER BY clause
    public function orderBy($column, $direction='') {
        if (is_array($column))
            $column = implode(', ', $column);
        $this->query .= "ORDER BY $column $direction ";
        return $this;
    }

    public function random($count) {
        $this->query .= "ORDER BY RAND() ";
        return $this->limit($count);
    }

    public function limit($number) {
        if (ctype_digit(strval($number)))
            $this->query .= "LIMIT $number ";
        return $this;
    }

    public function with($rel, $fk = null) {
        $this->rel = (is_array($rel)) ? $rel : [$rel];
        return $this;
    }

    public function select($columns='*') {
        if (is_array($columns))
            $columns = implode(', ', $columns);

        $this->query = "SELECT $columns FROM {$this->query}";
        $res = self::run($this->query, $this->params)->fetchAll(PDO::FETCH_CLASS, $this->class);

        if (!$res)
            return null;
        else {
            if (!empty($this->rel)) {
                // Load the objects in relationship
                foreach($res as $object)
                    foreach($this->rel as $relationship)
                        $object->load($relationship);
            }

            if (count($res) === 1)
                return $res[0];
            else
                return $res;
        }
    }

    // INSERTs a record with given arguments
    public function insert($args) {
        $fields = array_keys($args);
        $columns = $columns = implode(', ', $fields);
        $placeholders = ':'.implode(', :', $fields);
        $table = $this->query;

        $this->query = "INSERT INTO {$this->query} ($columns) VALUES ($placeholders)";
        $this->params = $args;

        self::run($this->query, $this->params);
        return self::table($table)->where('id', self::lastInsertId())->select();
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

    /*==================== Shortcut methods / aliases ====================*/
    /*====================================================================*/

    public function first() {
        if (!$this->query)
            return $this->where('id', 1)->limit(1)->select();
        else
            return $this->limit(1)->select();
    }

    public function find($id) {
        return $this->where('id', $id)->select();
    }

    public function get() {
        return $this->select();
    }

    public function all() {
        return $this->select();
    }
}