<?php

include "Country.php";

class CountryRepository {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new Country();
        $result->id = $row["id"];
        $result->name = $row["name"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM countries";
        $q = $this->db->prepare($sql);
        $q->execute();
        $rows = $q->fetchAll();

        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

}

?>