<?php

use MVC\Controller;
session_start();

class ControllersOrder extends Controller {
	public function index() {
		if (!empty($_SESSION['user_id'])) {
			$model = $this->model('order');
			$values = $model->getAll();
			include_once './Application/Views/order/list.php';
		} else {
			header("Location: /login");
			exit();
		}
	}

	public function insert() {
		if ($this->request->getMethod() == "POST") {
			if (isset($_POST['id']) && isset($_POST['total']) && isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['price'])) {
				$id = $_POST['id'];
				$total = $_POST['total'];
				$product_id = $_POST['product_id'];
				$quantity = $_POST['quantity'];
				$price = $_POST['price'];
				$currentDateTime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
				$formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
				$model = $this->model('order');
				$order_id = $model->insert($id, $total, $formattedDateTime);
				if ($order_id) {
					$orderItemModel = $this->model('orderItem');
					$this->updateProduct($product_id, $quantity);
					$orderItemModel->insert($order_id, $product_id, $quantity, $price);
					$model2 = $this->model('cart');
					$model2->deleteProductID($product_id);

					$data = [
						'message' => 'Thanh toán thành công!',
						'error' => false
					];
				} else {
					$data = [
						'message' => 'Thanh toán thất bại!',
						'error' => true
					];
				}
			}
		}
		$this->response->setContent($data);
	}

	public function create() {
		if ($this->request->getMethod() == "POST") {
			if (isset($_POST['id']) && isset($_POST['total']) && isset($_POST['cartItems'])) {
				$id = $_POST['id'];
				$total = $_POST['total'];
				$cartItems = $_POST['cartItems'];
				$currentDateTime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
				$formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
				$model = $this->model('order');
				$order_id = $model->insert($id, $total, $formattedDateTime);
				if ($order_id) {
					$orderItemModel = $this->model('orderItem');
					foreach ($cartItems as $item) {
						$product_id = $item['product_id'];
						$quantity = $item['quantity'];
						$price = $item['price'];

						$this->updateProduct($product_id, $quantity);
						$orderItemModel->insert($order_id, $product_id, $quantity, $price);
					}

					$model2 = $this->model('cart');
					$model2->deleteUserID($id);

					$data = [
						'data' => $order_id,
						'error' => false
					];
				} else {
					$data = [
						'message' => 'Thanh toán thất bại!',
						'error' => true
					];
				}
			}
		}
		$this->response->setContent($data);
	}

	public function show($param) {
		if (!empty($_SESSION['user_id'])) {
			$id = $param['id'];
			$options = [
				"Chờ xử lý",
				"Đang giao",
				"Đã hoàn thành"
			];
			$model = $this->model('order');
			$value = $model->getID($id);
			include_once './Application/Views/order/edit.php';
		} else {
			header("Location: /login");
			exit();
		}
	}

	public function update($param) {
		if ($this->request->getMethod() == "POST") {
			$id = $param['id'];
			$status = $this->request->request['status'];
			$model = $this->model('order');
			$result = $model->update($id, $status);
			if ($result == 1) {
				unset($_SESSION['error_message']);
				header("Location: /list-order");
				exit();
			} else {
				$_SESSION['error_message'] = "Cập nhật thất bại!";
				header("Location: /update-order/".$id);
				exit();
			}
		}
		unset($_SESSION['error_message']);
	}

	private function updateProduct($product_id, $quantity) {
		$model = $this->model('product');
		$stock = $model->getID($product_id);
		$model->updateStock($product_id, ($stock['stock']-$quantity));
	}
}