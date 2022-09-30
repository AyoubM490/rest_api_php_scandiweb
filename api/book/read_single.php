<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/config/Database.php';
include_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$book->read_single();

$book_arr = array(
    'id' => $book->id,
    'sku' => $book->sku,
    'name' => $book->name,
    'price' => $book->price,
    'weight' => $book->weight
);

print_r(json_encode($book_arr));
