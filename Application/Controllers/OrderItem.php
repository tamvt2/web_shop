<?php

use MVC\Controller;
session_start();

class ControllersOrderItem extends Controller {
	public function index() {
		if (!empty($_SESSION['user_id'])) {
			$model = $this->model('orderItem');
			$values = $model->getAll();
			include_once './Application/Views/order_item/list.php';
		} else {
			header("Location: /login");
			exit();
		}
	}
}