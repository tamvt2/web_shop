<?php

use MVC\Controller;
session_start();

class ControllersCart extends Controller {
	public function index() {
		if (!empty($_SESSION['user_id'])) {
			$model = $this->model('cart');
			$values = $model->getAll();
			include_once './Application/Views/cart_item/list.php';
		} else {
			header("Location: /login");
			exit();
		}
	}
}