<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../models/dvd.php';

$database = new Database();
$db = $database->connect();

$dvd = new DVD($db);

$dvd->id = isset($_GET['id']) ? $_GET['id'] : die();

$dvd->read_single();

$dvd_arr = array(
    "id" => $dvd->id,
    "sku" => $dvd->sku,
    "name" => $dvd->name,
    "price" => $dvd->price,
    "size" => $dvd->size
);

print_r(json_encode($dvd_arr));
