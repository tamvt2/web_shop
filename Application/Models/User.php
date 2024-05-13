<?php
use MVC\Model;

class ModelsUser extends Model {
	public function insert($username, $email, $password) {
		$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
		return $this->db->query($sql);
	}

	public function update($user_id, $name, $phone, $address) {
		$sql = "UPDATE users SET name = '$name', phone = '$phone', address = '$address' WHERE user_id = '$user_id'";
		return $this->db->query($sql);
	}

	public function login($email) {
		$query = $this->db->query("SELECT * FROM users WHERE email = '$email'");
		return $query;
	}

	public function checkUsername($username) {
		$query = $this->db->query("SELECT username FROM users WHERE username = '$username'");
        return $query->num_rows;
	}

	public function checkEmail($email) {
		$query = $this->db->query("SELECT email FROM users WHERE email = '$email'");
        return $query->num_rows;
	}
}