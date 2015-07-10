<?php

include "../models/ClientRepository.php";

$db = new PDO("mysql:host=127.0.0.1;dbname=jsgridsample", "root", "mysql");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$method = $_SERVER["REQUEST_METHOD"];

$clients = new ClientRepository($db);

header("Content-Type: application/json");

switch($method) {
    case "GET":
        echo json_encode($clients->getAll());
        break;

    case "POST":
        echo json_encode($clients->insert(array(
            name => $_POST["name"],
            age => intval($_POST["age"]),
            address => $_POST["address"],
            married => $_POST["married"] === "true" ? 1 : 0
        )));
        break;
}


?>