<?php

use MVC\Model;

class ModelsCart extends Model {

    public function getID($id) {
        // can you connect to database
        $sql = "SELECT cart_items.*, products.name, products.image, products.price FROM cart_items INNER JOIN products ON cart_items.product_id = products.product_id WHERE user_id = $id";
		return $this->db->query($sql);
    }

	public function insert($product_id, $user_id) {
		$sql = "INSERT INTO cart_items (user_id, product_id, quantity)
		VALUES ('$user_id', '$product_id', 1)";
		return $this->db->query($sql);
	}

	public function delete($id) {
		$query = $this->db->query("DELETE FROM cart_items WHERE cart_item_id = '$id'");
		return $query->num_rows;
	}
}
