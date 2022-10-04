<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods');
header('Access-Control-Allow-Methods: GET');

class Types extends Request
{
    private $types;
    function __construct()
    {
        parent::__construct();
        $this->types = $this->conn->query("SELECT `name` FROM `type`")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function all()
    {
        return $this->msg($this->types);
    }
    public function getSpecificAttr($type_name)
    {
        $stmt = $this->conn->prepare("SELECT `id` FROM `type` WHERE name=:type_name");
        $stmt->bindParam(':type_name', $type_name, PDO::PARAM_STR);
        $stmt->execute();
        $type = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($type) {
            $attrs = $this->conn->query("SELECT `name`, `units` FROM `additional_properties` WHERE `type_id`={$type['id']}")->fetch(PDO::FETCH_ASSOC);
            return $this->msg($attrs);
        } else return $this->msg("Type not found!", 404);
    }
}
