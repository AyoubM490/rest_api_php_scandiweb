<?php
class Book
{
    private $conn;
    private $table_name = "books";

    public $id;
    public $sku;
    public $name;
    public $price;
    public $weight;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT b.id, b.sku, b.name, b.price, b.weight FROM " . $this->table_name . " b";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        $query = "SELECT b.id, b.sku, b.name, b.price, b.weight FROM " . $this->table_name . " b WHERE b.id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->sku = $row['sku'];
        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->weight = $row['weight'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' 
            SET 
                sku = :sku, 
                name = :name, 
                price = :price, 
                weight = :weight';

        $stmt = $this->conn->prepare($query);

        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->weight = htmlspecialchars(strip_tags($this->weight));

        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':weight', $this->weight);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table_name . ' 
            SET 
                sku = :sku, 
                name = :name, 
                price = :price, 
                weight = :weight 
            WHERE 
                id = :id';

        $stmt = $this->conn->prepare($query);

        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->weight = htmlspecialchars(strip_tags($this->weight));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':weight', $this->weight);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
