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
}