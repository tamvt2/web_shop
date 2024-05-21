<?php

use MVC\Model;

class ModelsCart extends Model {

    public function getID($id) {
        // can you connect to database
        $sql = "SELECT cart_items.*, products.name, products.image, products.price, products.stock FROM cart_items INNER JOIN products ON cart_items.product_id = products.product_id WHERE user_id = $id";
		return $this->db->query($sql);
    }

	public function getProductID($id, $user_id) {
        // can you connect to database
        $query = $this->db->query("SELECT cart_items.*, products.name, products.image, products.price, products.stock FROM cart_items INNER JOIN products ON cart_items.product_id = products.product_id WHERE cart_items.product_id = $id AND cart_items.user_id = $user_id");
		return $query->row;
    }

	public function getAll() {
        // can you connect to database
        $query = $this->db->query("SELECT cart_items.*, products.name, users.username FROM cart_items INNER JOIN products ON cart_items.product_id = products.product_id INNER JOIN users ON cart_items.user_id = users.user_id");
		return $query->rows;
    }

	public function getQuantity($product_id, $user_id) {
		$query = $this->db->query("SELECT quantity FROM cart_items  WHERE  product_id = '$product_id' AND user_id = '$user_id'");
		return $query->row;
	}

	public function insert($product_id, $user_id) {
		$sql = "INSERT INTO cart_items (user_id, product_id, quantity)
		VALUES ('$user_id', '$product_id', 1)";
		return $this->db->query($sql);
	}

	public function update($product_id, $user_id, $quantity) {
		$query = $this->db->query("UPDATE cart_items SET quantity = $quantity WHERE product_id = '$product_id' AND user_id = '$user_id'");
		return $query->num_rows;
	}

	public function updateCart($id, $quantity) {
		$query = $this->db->query("UPDATE cart_items SET quantity = $quantity WHERE cart_item_id = '$id'");
		return $query->num_rows;
	}

	public function delete($id) {
		$query = $this->db->query("DELETE FROM cart_items WHERE cart_item_id = '$id'");
		return $query->num_rows;
	}

	public function deleteProductID($id) {
		$query = $this->db->query("DELETE FROM cart_items WHERE product_id = '$id'");
		return $query->num_rows;
	}

	public function deleteUserID($id) {
		$query = $this->db->query("DELETE FROM cart_items WHERE user_id = '$id'");
		return $query->num_rows;
	}
}
