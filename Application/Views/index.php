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

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-light bg-white topbar mb-4 static-top shadow d-flex justify-content-between pl-5 px-5">
					<div class="logo">
						<a href="/"><img class="w-50" src="public/assets/img/logo.jpg" alt=""></a>
					</div>
					<!-- Topbar Search -->
					<div class="d-flex align-items-center">
						<form class="form-inline my-2 my-md-0" action="/search" method="get">
							<div class="input-group">
								<input type="text" name="search" class="form-control bg-light border-0 small" style="width: 500px;" placeholder="Search for..."
									aria-label="Search" aria-describedby="basic-addon2">
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit">
										<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</form>
						<div class="cart">
							<a class="nav-link" href="#"><i class="fas fa-fw fa-shopping-cart"></i> Giỏ hàng</i></a>
						</div>
					</div>
				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">
					<section class="mt-5">
						<h2 class="text-center mb-4">Sản Phẩm Nổi Bật</h2>
						<div class="row">
							<?php
							// Lặp qua mỗi sản phẩm và hiển thị chúng
							foreach ($products as $product) {
								echo '<div class="col-md-2 mb-4">
									<div class="card">
										<img src="' . $product['image'] . '" class="card-img-top" style="height: 120px" alt="Product Image">
										<div class="card-body">
											<h5 class="card-title">' . $product['name'] . '</h5>
											<p class="card-text">' . $product['description'] . '</p>
											<div class="text-center d-flex">
												<a href="#" class="btn btn-primary mr-3">Thêm Vào Giỏ</a>
												<a href="#" class="btn btn-primary">Mua Ngay</a>
											</div>
										</div>
									</div>
								</div>';
							}
							?>
						</div>
					</section>
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Your Website 2021</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="public/assets/js/main.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="public/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="public/assets/js/demo/chart-area-demo.js"></script>
    <script src="public/assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>