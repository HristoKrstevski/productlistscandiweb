<?php

class DB
{
    protected $hostname;
    protected $db_name;
    protected $db_pass;
    protected $username;
    protected $table;
    protected $conn;

    public function __construct($table)
    {
        $this->db_name = "testdb";
        $this->db_pass = "secret";
        $this->hostname = "localhost";
        $this->username = "homestead";
        $this->table = $table;
        $this->conn = $this->connect();
    }

    public function connect()
    {
        // Create connection
        $conn = new mysqli($this->hostname, $this->username, $this->db_pass, $this->db_name);

        // Check connection
        if ($conn->connect_error) {
            return $conn->connect_error;
        }
        return $conn;
    }

    public function insert($data)
    {
        $keys = [];
        $values = [];
        foreach ($data as $key => $value) {
            $keys[] = $key;
            if($value == '') {
                $values[] = 'NULL';
            } else {
                $values[] = "'$value'";
            }

        }

        $keys = implode(',', $keys);
        $values = implode(',', $values);

        $queryInsert = "INSERT INTO $this->table ($keys) VALUES ($values)";

        try {
            $this->conn->query($queryInsert);
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }

        return $this->conn->insert_id;
    }

    public function getAll()
    {

        $querySelect = "SELECT * FROM $this->table INNER JOIN properties ON product.properties_id = properties.id";


        $result = $this->conn->query($querySelect);

        $results = [];

        while ($row = $result->fetch_object()) {
            $results[] = $row;
        }
        return $results;
    }

//    public function getInner($main_table, $inner_table, $main_table_property, $inner_table_property)

    public function getInner()
    {

//        $querySelect = "SELECT * FROM $this->table INNER JOIN $inner_table ON $main_table.$main_table_property = $inner_table.$inner_table_property";
        $querySelect = "SELECT product.id AS product_id, product.*, properties.id AS properties_id, properties.*
                FROM product
                INNER JOIN properties ON product.properties_id = properties.id;";

        $result = $this->conn->query($querySelect);

        $results = [];

        while ($row = $result->fetch_object()) {
            $results[] = $row;
        }
        return $results;
    }

    public function get($id)
    {
        var_dump($id);
        $querySelect = "SELECT * FROM $this->table WHERE id=$id";


        $result = $this->conn->query($querySelect);

        return $result->fetch_object();
    }


    public function update($id, $data)
    {
        $buildQuery = [];

        foreach ($data as $key => $value) {
            $buildQuery[] = "$key = '$value'";
        }

        $buildQuery = implode(',', $buildQuery);

        $queryExecute = "UPDATE $this->table SET $buildQuery WHERE id = '$id'";

        $result = $this->conn->query($queryExecute);

        return $result;
    }

    public function remove($ids)
    {

        $idList = implode(',', $ids);


        $querySelect = "DELETE FROM $this->table WHERE id IN ($idList)";


        $this->conn->query($querySelect);
    }

}