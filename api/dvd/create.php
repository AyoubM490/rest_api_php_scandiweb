<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/dvd.php';

$database = new Database();
$db = $database->connect();

$dvd = new DVD($db);

$data = json_decode(file_get_contents("php://input"));

$dvd->sku = $data->sku;
$dvd->name = $data->name;
$dvd->price = $data->price;
$dvd->size = $data->size;

if ($dvd->create()) {
    echo json_encode(
        array("message" => "DVD was created.")
    );
} else {
    echo json_encode(
        array("message" => "DVD was not created.")
    );
}
