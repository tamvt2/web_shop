<?php

use MVC\Model;

class ModelsProduct extends Model {

	public function insert($name, $description, $price, $stock, $category_id, $image) {
		$sql = "INSERT INTO products (name, description, price, stock, category_id, image)
		VALUES ('$name', '$description', $price, '$stock', $category_id, '$image')";
		return $this->db->query($sql);
	}

    public function getAll() {
        $query = $this->db->query("SELECT products.*, categories.name as category_name FROM products INNER JOIN categories ON products.category_id = categories.category_id");
		return $query->rows;
    }

	public function getID($id) {
		$query = $this->db->query("SELECT * FROM products WHERE product_id = '$id'");
		return $query->row;
	}

	public function update($id, $name, $description, $price, $stock, $category_id, $image) {
		$query = $this->db->query("UPDATE products SET name = '$name', description = '$description',
		price = $price, stock = '$stock', category_id = $category_id, image = '$image' WHERE product_id = '$id'");
		return $query->num_rows;
	}

	public function delete($id) {
		$query = $this->db->query("DELETE FROM products WHERE product_id = '$id'");
		return $query->num_rows;
	}
}
