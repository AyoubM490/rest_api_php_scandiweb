<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/config/Database.php';
include_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);

$data = json_decode(file_get_contents("php://input"));

$book->id = $data->id;
$book->sku = $data->sku;
$book->name = $data->name;
$book->price = $data->price;
$book->weight = $data->weight;

if ($book->update()) {
    echo json_encode(
        array('message' => 'Book Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Book Not Updated')
    );
}
