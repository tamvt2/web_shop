<?php

use MVC\Controller;


class ControllersProduct extends Controller {

	public function index() {
		$model = $this->model('product');
		$values = $model->getAll();
		include_once ('./Application/Views/product/list.php');
	}

	public function create() {
		$model = $this->model('category');
		$values = $model->getAll();
		include_once('./Application/Views/product/add.php');
	}

	public function insert() {
		if ($this->request->getMethod() == "POST") {
			$name = $this->request->request['name'];
			$description = $this->request->request['description'];
			$price = $this->request->request['price'];
			$stock = $this->request->request['stock'];
			$category_id = $this->request->request['category_id'];
			$image = $this->request->request['image'];

			if (!empty($name) && !empty($price)&& !empty($stock) && !empty($category_id) && !empty($image)) {
				$model = $this->model('product');
				$product = $model->insert($name, $description, $price, $stock, $category_id, $image);
				if ($product) {
					unset($_SESSION['error_message']);
					header("Location: /list-product");
					exit();
				} else {
					$_SESSION['error_message'] = "Thêm thất bại!";
					header("Location: /add-product");
					exit();
				}
			} else {
				$_SESSION['error_message'] = "Vui lòng nhập dữ liệu vào các mục";
				header("Location: /add-product");
				exit();
			}
		}
		unset($_SESSION['error_message']);
	}

	public function show($param) {
		$id = $param['id'];
		$model2 = $this->model('category');
		$values = $model2->getAll();
		$model = $this->model('product');
		$product = $model->getID($id);
		include_once './Application/Views/product/edit.php';
	}

	public function update($param) {
		if ($this->request->getMethod() == "POST") {
			$id = $param['id'];
			$name = $this->request->request['name'];
			$description = $this->request->request['description'];
			$price = $this->request->request['price'];
			$stock = $this->request->request['stock'];
			$category_id = $this->request->request['category_id'];
			$image = $this->request->request['image'];

			$model = $this->model('product');
			$product = $model->update($id, $name, $description, $price, $stock, $category_id, $image);
			if ($product == 1) {
				unset($_SESSION['error_message']);
				header("Location: /list-product");
				exit();
			} else {
				$_SESSION['error_message'] = "Thêm thất bại!";
				header("Location: /update-product/".$id);
				exit();
			}
		}
		unset($_SESSION['error_message']);
	}

	public function delete($param) {
		$id = $param['id'];
		$model = $this->model('product');
		$product = $model->delete($id);
		if ($product == 1) {
			$data = [
				'message' => 'Xóa thành công',
				'error' => false
			];
		} else {
			$data = [
				'message' => 'Xóa thất bại',
				'error' => true
			];
		}
		$this->response->setContent($data);
	}
}