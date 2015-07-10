<?php

include "Client.php";

class ClientRepository {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new Client();
        $result->id = $row["id"];
        $result->name = $row["name"];
        $result->age = $row["age"];
        $result->address = $row["address"];
        $result->married = $row["married"] == 1 ? true : false;
        return $result;
    }

    public function getById($id) {
        $sql = "SELECT * FROM clients WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":id", $id, PDO::PARAM_INT);
        $q->execute();
        $rows = $q->fetchAll();
        return $this->read($rows[0]);
    }

    public function getAll() {
        $result = [];

        $sql = "SELECT * FROM clients";
        $q = $this->db->prepare($sql);
        $q->execute();
        $rows = $q->fetchAll();

        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }

        return $result;
    }

    public function insert($data) {
        $sql = "INSERT INTO clients (name, age, address, married) VALUES (:name, :age, :address, :married)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name", $data["name"]);
        $q->bindParam(":age", $data["age"], PDO::PARAM_INT);
        $q->bindParam(":address", $data["address"]);
        $q->bindParam(":married", $data["married"], PDO::PARAM_INT);
        $q->execute();
        return $this->getById($this->db->lastInsertId());
    }

    public function update($data) {
        $sql = "UPDATE clients SET name = :name, age = :age, address = :address, married = :married WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name", $data["name"]);
        $q->bindParam(":age", $data["age"], PDO::PARAM_INT);
        $q->bindParam(":address", $data["address"]);
        $q->bindParam(":married", $data["married"], PDO::PARAM_INT);
        $q->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $q->execute();
    }

    public function remove($id) {
        $sql = "DELETE FROM clients WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":id", $id, PDO::PARAM_INT);
        $q->execute();
    }

}

?>