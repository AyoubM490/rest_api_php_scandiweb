<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../models/Dvd.php';

$database = new Database();
$db = $database->connect();

$dvd = new DVD($db);

$data = json_decode(file_get_contents("php://input"));

$dvd->id = $data->id;

if ($dvd->delete()) {
    echo json_encode(
        array("message" => "DVD was deleted.")
    );
} else {
    echo json_encode(
        array("message" => "DVD was not deleted.")
    );
}
