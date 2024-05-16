<?php

use MVC\Model;

class ModelsOrder extends Model {
	public function getAll() {
        // can you connect to database
        $query = $this->db->query("SELECT orders.*, users.username FROM orders INNER JOIN users ON orders.user_id = users.user_id");
		return $query->rows;
    }
}