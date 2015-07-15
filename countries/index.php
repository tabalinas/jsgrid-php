<?php

include "../models/CountryRepository.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$countries = new CountryRepository($db);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $countries->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>