<?php

include "Client.php";

class ClientRepository {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll() {
        $result = [];

        $sql = "SELECT * FROM clients";
        $rows = $this->db->query($sql);

        foreach($rows as $row) {
            $client = new Client();
            $client->name = $row["name"];
            $client->age = $row["age"];
            $client->address = $row["address"];
            $client->married = $row["married"] == 1 ? true : false;
            array_push($result, $client);
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
    }




}

?>