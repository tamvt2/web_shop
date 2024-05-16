<?php

use MVC\Model;

class ModelsOrderItem extends Model {
	public function getAll() {
        // can you connect to database
        $query = $this->db->query("SELECT order_items.*, products.name FROM order_items INNER JOIN products ON order_items.product_id = products.product_id");
		return $query->rows;
    }
}