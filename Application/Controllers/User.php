<?php

use MVC\Controller;

session_start();
class ControllersUser extends Controller {
	public function index() {
		session_unset();
		include_once './Application/Views/Login.php';
	}

	public function show() {
		include_once './Application/Views/Register.php';
	}

	public function register() {
		if ($this->request->getMethod() == "POST") {
			$username = $this->request->request['username'];
			$email = $this->request->request['email'];
			$password = $this->request->request['password'];
			$repeatPassword = $this->request->request['repeatPassword'];
			if (!empty($username) && !empty($email) && !empty($password) && !empty($repeatPassword)) {
				if (strlen($password) > 5) {
					if ($password === $repeatPassword) {
						$model = $this->model('user');
						$checkUsername = $model->checkUsername($username);
						$checkEmail = $model->checkEmail($email);
						if ($checkUsername == 0) {
							if ($checkEmail == 0) {
								$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
								// echo $hashedPassword;
								// Read All Task
								$user = $model->insert($username, $email, $hashedPassword);
								if ($user) {
									header("Location: /login");
									exit();
								} else {
									header("Location: /register");
									exit();
								}
							} else {
								// Tên đăng nhập đã tồn tại
								$_SESSION['error_message'] = "Email đã tồn tại, vui lòng nhập email khác";
							}
						} else {
							// Tên đăng nhập đã tồn tại
							$_SESSION['error_message'] = "Username đã tồn tại, vui lòng nhập Username khác";
						}
					} else {
						$_SESSION['error_message'] = "Mật khẩu và mật khẩu nhập lại không khớp nhau";
					}
				} else {
					$_SESSION['error_message'] = "Mật khẩu phải có ít nhất 6 ký tự";
				}
			} else {
				$_SESSION['error_message'] = "Vui lòng nhập Username, email, mật khẩu, và mật khẩu nhập lại";
			}
		} else {
			// Dữ liệu không được gửi từ form
			$_SESSION['error_message'] = "Dữ liệu không hợp lệ";
		}
		include_once './Application/Views/Register.php';
		unset($_SESSION['error_message']);
	}

	public function login() {
		if ($this->request->getMethod() == "POST") {
			$email = $this->request->request['email'];
			$password = $this->request->request['password'];
			if (!empty($email) && !empty($password)) {
				$model = $this->model('user');
				$result = $model->login($email);
				if ($result->num_rows == 1) {
					$hashedPasswordInDB = $result->row['password'];
					if (password_verify($password, $hashedPasswordInDB)) {
						// Mật khẩu đúng, đăng nhập thành công
						$_SESSION['user_id'] = $result->row['user_id'];
						$_SESSION['username'] = $result->row['username'];
						$_SESSION['email'] = $result->row['email'];
						$_SESSION['name'] = $result->row['name'];
						$_SESSION['phone'] = $result->row['phone'];
						$_SESSION['address'] = $result->row['address'];
						$_SESSION['role'] = $result->row['role'];
						print_r($_SESSION);
						if ($_SESSION['role'] == 'admin') {
							header("Location: /");
							exit();
						} else {
							header("Location: /user");
							exit();
						}
					} else {
						// Mật khẩu không đúng
						$_SESSION['error_message'] = "Mật khẩu không đúng";
					}
				} else {
					// Tài khoản không tồn tại
					$_SESSION['error_message'] = "Email không đúng";
				}
			} else {
				$_SESSION['error_message'] = "Vui lòng nhập email và mật khẩu";
			}
		}
		include_once './Application/Views/Login.php';
		unset($_SESSION['error_message']);
	}

	public function update() {
		if ($this->request->getMethod() == "POST") {
			$user_id = $_SESSION['user_id'];
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];

			$model = $this->model('user');
			$result = $model->update($user_id, $name, $phone, $address);
			if ($result->num_rows == 1) {
				$data = ['status' => true];
			} else {
				$data = ['status' => false];
			}

			header('Content-Type: application/json');
			$this->response->setContent($data);
		}
	}

	public function logout() {
		session_unset();
		header("Location: /login");
		exit();
	}
}