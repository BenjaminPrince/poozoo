<?php

class Database {
    private $db;

    public function __construct() {
        include './config/db.php';
        $this->db = $db;
    }

    public function add($table, $values) {
        $req = 'INSERT INTO ' . $table . ' (';
        foreach ($values as $key => $value) {
            if ($key != 'id') $req .= $key.",";
        }
        $req = substr($req, 0, -1);
        $req .= ') VALUES (';
        foreach ($values as $key => $value) {
            if ($key != 'id') $req .= "'" . $value."',";
        }
        $req = substr($req, 0, -1);
        $req .= ")";
        $query = $this->db->prepare($req);
        $query->execute();
    }

    public function update($table, $id, $values) {
        $request = 'UPDATE ' . $table . ' SET ';
        foreach ($values as $key => $value) {
            $request .= $key . " = '".$value."',";
        }
        $request = substr($request, 0, -1);
        $request .= "WHERE id = " . $id;

        $query = $this->db->prepare($request);
        $query->execute();
    }

    public function get($table, $id) {
        // On récupère les données d'une ligne SQL en spécifiant la table et l'id que l'on cherche
        $request = $this->db->query("SELECT * FROM $table WHERE id = '$id'");
        $data = $request->fetch();

        // On retourne les données brutes
        return $data;
    }

    public function getAll($table) {
        $request = $this->db->prepare("SELECT * FROM $table");
        $request->execute();
        $data = $request->fetchAll();

        return $data;
    }

    public function getAllWhere($table, $key, $value) {
        $request = $this->db->prepare("SELECT * FROM $table WHERE $key = '$value'");
        $request->execute();
        $data = $request->fetchAll();

        return $data;
    }

}