<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/furniture.php';

$database = new Database();
$db = $database->connect();

$furniture = new Furniture($db);

$stmt = $furniture->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $furniture_arr = array();
    $furniture_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $furniture_item = array(
            "id" => $id,
            "sku" => $sku,
            "name" => $name,
            "price" => $price,
            "height" => $height,
            "width" => $width,
            "length" => $length
        );

        array_push($furniture_arr["records"], $furniture_item);
    }

    http_response_code(200);

    echo json_encode($furniture_arr);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "No furniture found.")
    );
}
