<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/config/Database.php';
include_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);

$result = $book->read();

$num = $result->rowCount();

if ($num > 0) {
    $books_arr = array();
    $books_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $book_item = array(
            'id' => $id,
            'sku' => $sku,
            'name' => $name,
            'price' => $price,
            'weight' => $weight
        );

        array_push($books_arr['data'], $book_item);
    }

    echo json_encode($books_arr);
} else {
    echo json_encode(
        array('message' => 'No Books Found')
    );
}
