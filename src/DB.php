<?php

class DB {

    private $class;

    private $query;

    private $params = [];

    private $relationship;

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
<<<<<<< HEAD

/*        $bt = debug_backtrace();
        var_dump($bt);die();
    $caller_class = (isset($bt[1]['class']) ? $bt[1]['class'] : null);
    echo $caller_class."<br>";*/
=======
>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2
        // Get the class name from the Model Resolver
        $db->class = ModelResolver::getClass($table);
        
        /* this works, but is messy ;)
        if ($table == 'addresses')
            $db->class = "Address";
        else {
            $table_arr = explode("_", trim($table));
            $db->class = substr( ucfirst($table_arr[0]) . ucfirst( isset($table_arr[1]) ? $table_arr[1] : "" ), 0, -1);
        }*/
        //old stuf... $db->class = ucfirst(substr(trim($table),0,-1));
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
        $this->relationship = (is_array($rel)) ? $rel : [$rel];
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
            if (!empty($this->relationship)) {
                // Load the objects in relationship
                foreach($res as $object)
<<<<<<< HEAD
                    foreach($this->relationship as $relationship) {
                        if (strpos($relationship, '.') !== false) {
                            $rels = explode(".", $relationship);

                            $parent_rel_name = $rels[0];
                            $nested_rel_name = $rels[1];

                            $parent_rel = $object->$parent_rel_name();
                            foreach($parent_rel as $rel)
                                if ($rel)
                                    $rel->$nested_rel_name = $rel->$nested_rel_name();

                            $object->$parent_rel_name = $parent_rel;
                        }
                        else
                            $object->$relationship = $object->$relationship();
                    }
=======
                    foreach($this->relationship as $relationship)
                        $object->$relationship = $object->$relationship();
>>>>>>> 4ebd9df5ef231b7df010269c13d9d233788bf8c2

                    //load($relationship);
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