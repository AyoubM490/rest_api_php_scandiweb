<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);

$data = json_decode(file_get_contents("php://input"));

$book->sku = $data->sku;
$book->name = $data->name;
$book->price = $data->price;
$book->weight = $data->weight;

if ($book->create()) {
    echo json_encode(
        array('message' => 'Book Created')
    );
} else {
    echo json_encode(
        array('message' => 'Book Not Created')
    );
}
