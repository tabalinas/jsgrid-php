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
        $result->country_id = $row["country_id"];
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

    public function getAll($filter) {
        $name = "%" . $filter["name"] . "%";
        $address = "%" . $filter["address"] . "%";
        $country_id = $filter["country_id"];

        $sql = "SELECT * FROM clients WHERE name LIKE :name AND address LIKE :address AND (:country_id = 0 OR country_id = :country_id)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name", $name);
        $q->bindParam(":address", $address);
        $q->bindParam(":country_id", $country_id);
        $q->execute();
        $rows = $q->fetchAll();

        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

    public function insert($data) {
        $sql = "INSERT INTO clients (name, age, address, married, country_id) VALUES (:name, :age, :address, :married, :country_id)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name", $data["name"]);
        $q->bindParam(":age", $data["age"], PDO::PARAM_INT);
        $q->bindParam(":address", $data["address"]);
        $q->bindParam(":married", $data["married"], PDO::PARAM_INT);
        $q->bindParam(":country_id", $data["country_id"], PDO::PARAM_INT);
        $q->execute();
        return $this->getById($this->db->lastInsertId());
    }

    public function update($data) {
        $sql = "UPDATE clients SET name = :name, age = :age, address = :address, married = :married, country_id = :country_id WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name", $data["name"]);
        $q->bindParam(":age", $data["age"], PDO::PARAM_INT);
        $q->bindParam(":address", $data["address"]);
        $q->bindParam(":married", $data["married"], PDO::PARAM_INT);
        $q->bindParam(":country_id", $data["country_id"], PDO::PARAM_INT);
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