<?php
use MVC\Model;

class ModelsCategory extends Model {
	public function insert($name) {
		$sql = "INSERT INTO categories (name) VALUES ('$name')";
		return $this->db->query($sql);
	}

	public function getAll() {
        $query = $this->db->query("SELECT * FROM categories");
		return $query->rows;
    }

	public function getID($id) {
		$query = $this->db->query("SELECT * FROM categories WHERE category_id = '$id'");
		return $query->row;
	}

	public function update($id, $name) {
		$query = $this->db->query("UPDATE categories SET name = '$name' WHERE category_id = '$id'");
		return $query->num_rows;
	}

	public function delete($id) {
		$query = $this->db->query("DELETE FROM categories WHERE category_id = '$id'");
		return $query->num_rows;
	}
}