<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/dvd.php';

$database = new Database();
$db = $database->connect();

$dvd = new DVD($db);

$stmt = $dvd->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $dvds_arr = array();
    $dvds_arr["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $dvd_item = array(
            "id" => $id,
            "sku" => $sku,
            "name" => $name,
            "price" => $price,
            "size" => $size
        );

        array_push($dvds_arr["data"], $dvd_item);
    }

    http_response_code(200);

    echo json_encode($dvds_arr);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "No dvds found.")
    );
}
