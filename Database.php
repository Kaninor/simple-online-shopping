<?php

class Database
{
    public function __construct($host='localhost', $user='root', $password='', $database='store') 
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    private function make_connection()
    {
        return mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function select($table, $condition=1) 
    {
        $query = "SELECT * FROM $table WHERE $condition";
        return mysqli_query($this->make_connection(), $query);
    }

    public function join($fields, $table, $join_expression, $condition=1) 
    {
        $query = "SELECT " . join(',', $fields) . " FROM $table JOIN $join_expression WHERE $condition";
        return mysqli_query($this->make_connection(), $query);
    }

    public function fetch($result)
    {
        return mysqli_fetch_array($result);
    }

    public function insert($table, $fields, $values)
    {
        $query = "INSERT INTO $table (" . join(',', $fields) . ") VALUES (" . join(',', $values) . ")";
        return mysqli_query($this->make_connection(), $query);
    }

    public function delete($table, $condition=0)
    {
        $query = "DELETE FROM $table WHERE $condition";
        mysqli_query($this->make_connection(), $query);
    }

    public function count($result)
    {
        return mysqli_num_rows($result);
    }
}