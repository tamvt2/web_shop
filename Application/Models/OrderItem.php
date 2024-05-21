<?php

use MVC\Model;

class ModelsOrderItem extends Model {
	public function getAll() {
        // can you connect to database
        $query = $this->db->query("SELECT order_items.*, products.name FROM order_items INNER JOIN products ON order_items.product_id = products.product_id");
		return $query->rows;
    }

	public function insert($order_id, $product_id, $quantity, $price) {
		$sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
		VALUES ('$order_id', '$product_id', '$quantity', '$price')";
		return $this->db->query($sql);
	}
}