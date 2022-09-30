<?php
class Database
{
    private $host = "us-cdbr-east-06.cleardb.net";
    private $db_name = "heroku_34fe46c9712aa54";
    private $username = "bd31a3d5a96387";
    private $password = "c82f3aa9";
    public $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
