<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/furniture.php';

$database = new Database();
$db = $database->connect();

$furniture = new Furniture($db);

$data = json_decode(file_get_contents("php://input"));

$furniture->id = $data->id;

if ($furniture->delete()) {
    echo json_encode(
        array("message" => "Furniture was deleted.")
    );
} else {
    echo json_encode(
        array("message" => "Furniture was not deleted.")
    );
}
