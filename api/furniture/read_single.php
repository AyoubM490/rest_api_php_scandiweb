<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/furniture.php';

$database = new Database();
$db = $database->connect();

$furniture = new Furniture($db);

$furniture->id = isset($_GET['id']) ? $_GET['id'] : die();

$furniture->read_single();

$furniture_arr = array(
    "id" => $furniture->id,
    "sku" => $furniture->sku,
    "name" => $furniture->name,
    "price" => $furniture->price,
    "height" => $furniture->height,
    "width" => $furniture->width,
    "length" => $furniture->length
);

print_r(json_encode($furniture_arr));
