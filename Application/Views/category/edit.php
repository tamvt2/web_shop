<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?=ROOT_URL?>public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=ROOT_URL?>public/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
			include_once "./Application/Views/layout/sidebar.php";
		?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <?php
						include_once './Application/Views/layout/topbar.php'
					?>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">

        			<!-- Outer Row -->
					<div class="row justify-content-center mt-5">
						<div class="col-xl-10 col-lg-12 col-md-9">
							<div class="card-body p-0">
								<?php
									// Hiển thị thông báo lỗi nếu có
									if (isset($_SESSION['error_message'])) {
										echo '<div class="mb-2 ml-3 text-danger">' . $_SESSION['error_message'] . '</div>';
									}
								?>
								<form class="user" method="post" action="/update-category/<?php echo $value['category_id'] ?>">
									<div class="form-group">
										<label for="name" class="form-label ml-3">Tên danh mục</label>
										<input type="text" class="form-control form-control-user"
											name="name"
											placeholder="Nhập tên danh mục" value="<?php echo $value['name'] ?>">
									</div>
									<button class="btn btn-primary btn-user btn-block">
										Lưu
									</button>
								</form>
							</div>
						</div>

					</div>

				</div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
				<div class="modal-body">
					<!-- Form bắt đầu ở đây -->
					<form id="myForm">
						<div class="mb-3">
							<label for="username" class="form-label">Username:</label>
							<input type="text" class="form-control" id="username" name="username" required disabled value="<?php echo $_SESSION['username'] ?>">
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email:</label>
							<input type="email" class="form-control" id="email" name="email" required disabled value="<?php echo $_SESSION['email'] ?>">
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Name:</label>
							<input type="text" class="form-control" id="name" name="name" value="<?php if (isset($_SESSION['name'])) {
								echo $_SESSION['name'];
							} ?>">
						</div>
						<div class="mb-3">
							<label for="phone" class="form-label">Phone:</label>
							<input type="number" class="form-control" id="phone" name="phone" value="<?php if (isset($_SESSION['phone'])) {
								echo $_SESSION['phone'];
							} ?>">
						</div>
						<div class="mb-3">
							<label for="address" class="form-label">Address:</label>
							<input type="text" class="form-control" id="address" name="address" value="<?php if (isset($_SESSION['address'])) {
								echo $_SESSION['address'];
							} ?>">
						</div>
						<!-- Thêm các trường form khác nếu cần -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary">Lưu</button>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?=ROOT_URL?>public/assets/js/main.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="<?=ROOT_URL?>public/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=ROOT_URL?>public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?=ROOT_URL?>public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?=ROOT_URL?>public/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?=ROOT_URL?>public/assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?=ROOT_URL?>public/assets/js/demo/chart-area-demo.js"></script>
<script src="<?=ROOT_URL?>public/assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>