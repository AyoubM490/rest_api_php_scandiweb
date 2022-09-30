<?php
class Furniture
{
    private $conn;
    private $table_name = "furnitures";

    public $id;
    public $sku;
    public $name;
    public $price;
    public $height;
    public $width;
    public $length;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT 
                    f.id, 
                    f.sku, 
                    f.name, 
                    f.price, 
                    f.height, 
                    f.width, 
                    f.length 
                FROM ' . $this->table_name . ' f';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT 
                    f.id, 
                    f.sku, 
                    f.name, 
                    f.price, 
                    f.height, 
                    f.width, 
                    f.length 
                FROM ' . $this->table_name . ' f 
                WHERE f.id = :id 
                LIMIT 0,1';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->sku = $row['sku'];
        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->height = $row['height'];
        $this->width = $row['width'];
        $this->length = $row['length'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' 
                SET 
                    sku = :sku, 
                    name = :name, 
                    price = :price, 
                    height = :height, 
                    width = :width, 
                    length = :length';

        $stmt = $this->conn->prepare($query);

        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->height = htmlspecialchars(strip_tags($this->height));
        $this->width = htmlspecialchars(strip_tags($this->width));
        $this->length = htmlspecialchars(strip_tags($this->length));

        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':height', $this->height);
        $stmt->bindParam(':width', $this->width);
        $stmt->bindParam(':length', $this->length);

        if ($this->sku != '') {
            $stmt->execute();
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
                    height = :height, 
                    width = :width, 
                    length = :length 
                WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->height = htmlspecialchars(strip_tags($this->height));
        $this->width = htmlspecialchars(strip_tags($this->width));
        $this->length = htmlspecialchars(strip_tags($this->length));

        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':height', $this->height);
        $stmt->bindParam(':width', $this->width);
        $stmt->bindParam(':length', $this->length);

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
