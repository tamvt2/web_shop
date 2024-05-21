<?php

use MVC\Model;

class ModelsOrder extends Model {
	public function getAll() {
        // can you connect to database
        $query = $this->db->query("SELECT orders.*, users.username FROM orders INNER JOIN users ON orders.user_id = users.user_id");
		return $query->rows;
    }

	public function insert($id, $total, $created_at) {
		$sql = "INSERT INTO orders (user_id, total, status, created_at)
		VALUES ('$id', '$total', 'Chờ xử lý', '$created_at')";
		$this->db->query($sql);

		return $this->db->getLastId();
	}

	public function getID($id) {
        // can you connect to database
        $query = $this->db->query("SELECT orders.*, users.username FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE order_id = $id");
		return $query->row;
    }

	public function update($id, $status) {
		$query = $this->db->query("UPDATE orders SET status = '$status' WHERE order_id = '$id'");
		return $query->num_rows;
	}
}