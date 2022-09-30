<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/furniture.php';

$database = new Database();
$db = $database->connect();

$furniture = new Furniture($db);

$data = json_decode(file_get_contents("php://input"));

$furniture->id = $data->id;
$furniture->sku = $data->sku;
$furniture->name = $data->name;
$furniture->price = $data->price;
$furniture->height = $data->height;
$furniture->width = $data->width;
$furniture->length = $data->length;

if ($furniture->update()) {
    echo json_encode(
        array("message" => "Furniture was updated.")
    );
} else {
    echo json_encode(
        array("message" => "Furniture was not updated.")
    );
}
