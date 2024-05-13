<?php

use MVC\Controller;

session_start();
class ControllersCategory extends Controller {
	public function index() {
		$model = $this->model('category');
		$values = $model->getAll();
		include_once './Application/Views/category/list.php';
	}

	public function create() {
		include_once './Application/Views/category/add.php';
	}

	public function insert() {
		if ($this->request->getMethod() == "POST") {
			$name = $this->request->request['name'];
			if (!empty($name)) {
				$model = $this->model('category');
				$result = $model->insert($name);
				if ($result) {
					unset($_SESSION['error_message']);
					header("Location: /list-category");
					exit();
				} else {
					$_SESSION['error_message'] = 'Thêm thất bại!';
					header("Location: /add-category");
					exit();
				}
 			} else {
				$_SESSION['error_message'] = "Vui lòng nhập dữ liệu vào các mục";
				header("Location: /add-category");
				exit();
			}
		}
		unset($_SESSION['error_message']);
	}

	public function show($param) {
		$id = $param['id'];
		$model = $this->model('category');
		$value = $model->getID($id);
		include_once './Application/Views/category/edit.php';
	}

	public function update($param) {
		if ($this->request->getMethod() == "POST") {
			$id = $param['id'];
			$name = $this->request->request['name'];
			$model = $this->model('category');
			$result = $model->update($id, $name);
			if ($result == 1) {
				unset($_SESSION['error_message']);
				header("Location: /list-category");
				exit();
			} else {
				$_SESSION['error_message'] = 'Sửa thất bại!';
				header("Location: /update-category/".$id);
				exit();
			}
		}
		unset($_SESSION['error_message']);
	}

	public function delete($param) {
		$id = $param['id'];
		$model = $this->model('category');
		$result = $model->delete($id);
		if ($result == 1) {
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