<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/Dvd.php';

$database = new Database();
$db = $database->connect();

$dvd = new DVD($db);

$data = json_decode(file_get_contents("php://input"));

$dvd->id = $data->id;
$dvd->sku = $data->sku;
$dvd->name = $data->name;
$dvd->price = $data->price;
$dvd->size = $data->size;

if ($dvd->update()) {
    echo json_encode(
        array("message" => "DVD was updated.")
    );
} else {
    echo json_encode(
        array("message" => "DVD was not updated.")
    );
}
