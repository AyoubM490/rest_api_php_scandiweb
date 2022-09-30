<?php
class DVD
{
    private $conn;
    private $table_name = "dvds";

    public $id;
    public $sku;
    public $name;
    public $price;
    public $size;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT d.id, d.sku, d.name, d.price, d.size FROM " . $this->table_name . " d";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        $query = "SELECT d.id, d.sku, d.name, d.price, d.size FROM " . $this->table_name . " d WHERE d.id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->sku = $row['sku'];
        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->size = $row['size'];
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET sku=:sku, name=:name, price=:price, size=:size";
        $stmt = $this->conn->prepare($query);

        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->size = htmlspecialchars(strip_tags($this->size));

        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":size", $this->size);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET sku=:sku, name=:name, price=:price, size=:size WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
