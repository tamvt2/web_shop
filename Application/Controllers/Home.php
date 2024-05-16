<?php

use MVC\Controller;
session_start();

class ControllersHome extends Controller {
	public function index() {
		if (!empty($_SESSION['user_id'])) {
			$id = $_SESSION['user_id'];
			$model = $this->model('product');
			$products = $model->getAll();
			$model2 = $this->model('cart');
			$carts = $model2->getID($id);
			include_once './Application/Views/index.php';
		} else {
			header("Location: /login");
			exit();
		}
	}

	public function search() {
		$data = array();
		if (isset($_GET['name'])) {
			$name = $_GET['name'];
			$model = $this->model('product');
			$value = $model->getName($name);
			if ($value) {
				$data = [
					'data' => $value,
					'user_id' => $_SESSION['user_id'],
					'error' => false
				];
			} else {
				$data = [
					'error' => true
				];
			}
		} else {
			$data = [
				'error' => true
			];
		}
		$this->response->setContent($data);
	}

	public function addCart() {
		$data = array();
		if (isset($_POST['product_id']) && isset($_POST['user_id'])) {
			$product_id = $_POST['product_id'];
			$user_id = $_POST['user_id'];
			$model = $this->model('cart');
			$result = $model->getQuantity($product_id, $user_id);
			if ($result) {
				$data = $this->update($product_id, $user_id, $result['quantity']);
			} else {
				$data = $this->insert($product_id, $user_id);
			}
		}
		$this->response->setContent($data);
	}

	public function buyCart() {
		$data = array();
		if (isset($_POST['product_id']) && isset($_POST['user_id'])) {
			$product_id = $_POST['product_id'];
			$user_id = $_POST['user_id'];
			$model = $this->model('cart');
			$result = $model->getQuantity($product_id, $user_id);
			if ($result) {
				$data = $this->update2($product_id, $user_id, $result['quantity']);
			} else {
				$data = $this->insert2($product_id, $user_id);
			}
		}
		$this->response->setContent($data);
	}

	private function insert($product_id, $user_id) {
		$model = $this->model('cart');
		$result = $model->insert($product_id, $user_id);
		if ($result) {
			$carts = $this->getID($user_id);
			$data = [
				'count' => $carts->num_rows,
				'data' => $carts->rows,
				'error' => false
			];
		} else {
			$data = [
				'error' => true
			];
		}
		return $data;
	}

	private function update($product_id, $user_id, $quantity) {
		$model = $this->model('cart');
		$result = $model->update($product_id, $user_id, $quantity+1);
		if ($result) {
			$carts = $this->getID($user_id);
			$data = [
				'data' => $carts->rows,
				'user_id' => $_SESSION['user_id'],
				'error' => false
			];
		} else {
			$data = [
				'error' => true
			];
		}
		return $data;
	}

	private function insert2($product_id, $user_id) {
		$model = $this->model('cart');
		$result = $model->insert($product_id, $user_id);
		if ($result) {
			$value = $this->getID($user_id);
			$carts = $model->getProductID($product_id);
			$data = [
				'data' => $carts,
				'count' => $value->num_rows,
				'data2' => $value->rows,
				'error' => false
			];
		} else {
			$data = [
				'error' => true
			];
		}
		return $data;
	}

	private function update2($product_id, $user_id, $quantity) {
		$model = $this->model('cart');
		$result = $model->update($product_id, $user_id, $quantity+1);
		if ($result) {
			$value = $this->getID($user_id);
			$carts = $model->getProductID($product_id);
			$data = [
				'data' => $carts,
				'data2' => $value,
				'user_id' => $_SESSION['user_id'],
				'error' => false
			];
		} else {
			$data = [
				'error' => true
			];
		}
		return $data;
	}

	private function getID($user_id) {
		$model = $this->model('cart');
		$carts = $model->getID($user_id);
		if ($carts) {
			$data = $carts;
		}
		return $data;
	}

	public function updateCart($param) {
		if ($this->request->getMethod() == "POST") {
			$id = $param['id'];
			$quantity = $_POST['quantity'];
			$model = $this->model('cart');
			$result = $model->updateCart($id, $quantity);
			if ($result) {
				$data = [
					'data' => $result,
					'error' => false
				];
			} else {
				$data = [
					'error' => true
				];
			}
		}
		$this->response->setContent($data);
	}

	public function delete($param) {
		$id = $param['id'];
		$user_id = $_POST['id'];
		$model = $this->model('cart');
		$result = $model->delete($id);
		if ($result == 1) {
			$model2 = $this->model('cart');
			$carts = $model2->getID($user_id);
			$data = [
				'count' => $carts->num_rows,
				'error' => false
			];
		} else {
			$data = [
				'error' => true
			];
		}
		$this->response->setContent($data);
	}

	public function upload() {
		// $this->response->setContent([
		// 	'error' => false,
		// 	'url' => 'public/assets/img/2.jpg'
		// ]);
		$target_dir = "Upload/Images/";
		$image = $this->request->files['file'];
		$target_file = $target_dir . basename($image['name']);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$errors = array();

		if (!is_dir($target_dir)) {
			// Thư mục chưa tồn tại, tạo thư mục
			if (mkdir($target_dir, 0777, true)) {
				$uploadOk = 1;
			} else {
				$errors[] = "Folder does not exist";
				$uploadOk = 0;
			}
		}

		// Check if image file is a actual image or fake image
		if (isset($image['name'])) {
			$check = getimagesize($image["tmp_name"]);
			if($check !== false) {
				// $errors[] = "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$errors[] = "File is not an image.";
				$uploadOk = 0;
			}
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			$errors[] = "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// Check file size
		if ($image["size"] > 5000000) {
			$errors[] = "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$this->response->setContent($errors);
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($image["tmp_name"], $target_file)) {
				$this->response->setContent([
					'error' => false,
					'url' => ROOT_URL . $target_file
				]);
			} else {
				$errors[] = "Sorry, there was an error uploading your file.";
			}
		}
	}
}
