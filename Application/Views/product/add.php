<!DOCTYPE html>
<html lang="en">

<head>
	<?php session_start(); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/assets/css/sb-admin-2.min.css" rel="stylesheet">

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
								<form class="user" method="post" action="/add-product">
									<div class="form-group">
										<label class="form-label ml-3">Tên danh mục</label>
										<select name="category_id" class="form-control">
											<?php
												foreach ($values as $value) {
													echo '<option value="'.$value['category_id'].'">'.$value['name'].'</option>';
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label for="name" class="form-label ml-3">Tên sản phẩm</label>
										<input type="text" class="form-control form-control-user"
											name="name" placeholder="Nhập tên sản phẩm">
									</div>
									<div class="form-group">
										<label for="description" class="form-label ml-3">Mô tả sản phẩm</label>
										<textarea class="form-control form-control-user"
											name="description" placeholder="Nhập mô tả sản phẩm"></textarea>
									</div>
									<div class="form-group">
										<label for="price" class="form-label ml-3">Giá sản phẩm</label>
										<input type="number" class="form-control form-control-user"
											name="price" placeholder="Nhập giá sản phẩm">
									</div>
									<div class="form-group">
										<label for="stock" class="form-label ml-3">Số lượng hàng tồn kho</label>
										<input type="number" class="form-control form-control-user"
											name="stock" placeholder="Nhập số lượng hàng tồn kho">
									</div>
									<div class="form-group">
										<label for="image" class="form-label ml-3">Hình ảnh sản phẩm</label>
										<input type="file" name="file" class="form-control mb-2" id="upload" value="Upload">
										<div id="image_show"></div>
										<input type="hidden" name="image" id="thumb">
									</div>
									<button class="btn btn-primary btn-user btn-block">
										Thêm
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
    <?php
		include_once './Application/Views/layout/profile.php';
		include_once './Application/Views/layout/script.php';
	?>
</body>

</html>