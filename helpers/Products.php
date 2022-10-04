<?php
abstract class Products extends Request{
	protected function getAll()
	{
		$stmt =	"SELECT
					 prod.sku,
					 prod.name AS `product`,
				     t.name AS `product_type`, 
				     props.name AS `property`, 
				     k_v.value AS `property_value`, 
				     props.units AS `units`,  
				     prod.price AS `price` 
				FROM `keys_and_values` `k_v` 
				     INNER JOIN `products` `prod` ON k_v.prod_id = prod.id 
				     INNER JOIN `type` `t` ON t.id=k_v.type_id 
				     INNER JOIN `additional_properties` `props` ON k_v.ad_prop_id=props.id 
				ORDER BY 
					prod.id DESC";
		$products = $this->conn->query($stmt)->fetchAll(PDO::FETCH_ASSOC);
		return $products;
	}
}
?>