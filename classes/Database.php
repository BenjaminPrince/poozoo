<?php

class Database {
    private $db;

    public function __construct() {
        include './config/db.php';
        $this->db = $db;
    }

    public function addRow($table, $values) {

    }

    public function updateRow($table, $id, $values) {
        $request = 'UPDATE ' . $table . ' SET ';
        foreach ($values as $key => $value) {
            $request .= $key . " = '".$value."',";
        }
        $request = substr($request, 0, -1);
        $request .= "WHERE id = " . $id;

        $query = $this->db->prepare($request);
        $query->execute();
    }
}