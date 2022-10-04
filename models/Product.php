<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: application/json');
    die();
}
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Content-Type: application/json');

//for production
// header('Access-Control-Allow-Origin: https://scandi-app.000webhostapp.com/');//resources allowed
// header('Access-Control-Allow-Headers: Origin, Content-type');
// header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
// header('Content-Type: application/json');

class Product extends Products
{
    private $errors;
    public function all()
    {
        $products = $this->getAll();
        return $this->msg($products);
    }
    public function store()
    {
        $input = file_get_contents('php://input');
        $input = json_decode($input);

        if (!Validator::validSKU($input->{'sku'})) {
            $this->errors["sku"] = "Please, provide a valid SKU with length of 8 symbols. Uppercase letters and numbers allowed";
        }

        if (!Validator::validName($input->{'name'})) {
            $this->errors["name"] = "Please, provide a valid name with min length of 3 symbols. Letters and numbers allowed";
        }

        if (!Validator::validNumInp($input->{"price"})) {
            $this->errors["price"] = "Please, provide a float type price that's > 0";
        }
        if (!Validator::validNumInp($input->{"spec_attr"})) {
            $this->errors["spec_attr"] = "Please, provide a float type spec. attr that's > 0";
        }
        if (empty($this->errors)) {
            try {
                $prod_stmt = $this->conn->prepare("INSERT INTO `products` (sku, name, price) VALUES (:sku, :name, :price)");
                $prod_stmt->bindParam(':sku', $input->{"sku"}, PDO::PARAM_STR);
                $prod_stmt->bindParam(':name', $input->{"name"}, PDO::PARAM_STR);
                $prod_stmt->bindParam(':price', $input->{"price"});
                $prod_stmt->execute();
                $productId = $this->conn->lastInsertId();
            } catch (Exception $e) {
                if ($e->getCode() == 23000) $this->errors["sku"] = "SKU must be unique";
                return $this->msg(array("errors" => $this->errors));
            }
            if ($productId) {
                $type_stmt = $this->conn->prepare("SELECT id FROM `type` WHERE name=:name");
                $type_stmt->bindParam(':name', $input->{"type"});
                $type_stmt->execute();
                $type = $type_stmt->fetch(PDO::FETCH_ASSOC);
                $ad_prop_stmt = $this->conn->prepare("SELECT id FROM `additional_properties` WHERE type_id=:type_id");
                $ad_prop_stmt->bindParam(':type_id', $type["id"], PDO::PARAM_INT);
                $ad_prop_stmt->execute();
                $ad_prop = $ad_prop_stmt->fetch(PDO::FETCH_ASSOC);
                if ($ad_prop) {
                    $props_and_val_stmt = $this->conn->prepare("INSERT INTO `keys_and_values` (prod_id, type_id, ad_prop_id, value) VALUES(:prod_id, :type_id, :ad_prop_id, :value)");
                    $props_and_val_stmt->bindParam(':prod_id', $productId, PDO::PARAM_INT);
                    $props_and_val_stmt->bindParam(':type_id', $type["id"], PDO::PARAM_INT);
                    $props_and_val_stmt->bindParam(':ad_prop_id', $ad_prop["id"], PDO::PARAM_INT);
                    $props_and_val_stmt->bindParam(':value', $input->{"spec_attr"});
                    $props_and_val_stmt->execute();
                    $added_prod = $this->conn->lastInsertId();
                    if ($added_prod) return $this->msg("New product was successfuly stored");
                }
            }
        } else return $this->msg(array("errors" => $this->errors));
    }
    public function delete()
    {
        $skuList = json_decode(file_get_contents("php://input"));
        $params_string = "";
        foreach ($skuList as $sku) {
            $sku = strip_tags($sku);
            $params_string .= "'{$sku}',";
        }
        $params_string = trim($params_string, ",");
        $prod_ids = $this->conn->query("SELECT `id` FROM `products` WHERE `sku` IN ({$params_string})")->fetchAll(PDO::FETCH_ASSOC);
        if (count($prod_ids) > 0) {
            $params_string = "";
            foreach ($prod_ids as $prod) {
                $params_string .= $prod["id"] . ",";
            }
            $params_string = trim($params_string, ",");
            $del_prods = $this->conn->query("DELETE FROM `products` WHERE `id` IN (" . $params_string . ")")->rowCount();
            $del_ref = $this->conn->query("DELETE FROM `keys_and_values` WHERE `prod_id` IN (" . $params_string . ")")->rowCount();
            if (($del_ref > 0 && $del_prods > 0)) {
                return $this->msg("{$del_ref} row(s) were successfuly deleted");
            }
        } else return $this->msg("rows not found", 404);
    }
}
