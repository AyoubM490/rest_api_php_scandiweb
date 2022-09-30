<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../models/Furniture.php';

$database = new Database();
$db = $database->connect();

$furniture = new Furniture($db);

$data = json_decode(file_get_contents("php://input"));

$furniture->sku = $data->sku;
$furniture->name = $data->name;
$furniture->price = $data->price;
$furniture->height = $data->height;
$furniture->width = $data->width;
$furniture->length = $data->length;

if ($furniture->create()) {
    echo json_encode(
        array("message" => "Furniture was created.")
    );
} else {
    echo json_encode(
        array("message" => "Furniture was not created.")
    );
}
