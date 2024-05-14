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
    <link href="public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/assets/css/sb-admin-2.min.css" rel="stylesheet">

	<style>
		.zoom-img {
			transition: transform 0.5s, z-index 0.5s; /* thời gian chuyển đổi */
		}
		.zoom-img:hover {
			transform: scale(1.5);
			z-index: 10;
			position: relative;
		}

		.m-cart {
			margin-left: -0.5rem !important;
			margin-top: -0.5rem !important;
		}

		.mw {
			max-width: 750px !important;
		}
	</style>
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
						<form class="form-inline my-2 my-md-0">
							<div class="input-group">
								<input type="text" id="searchInput" class="form-control bg-light border-0 small" style="width: 500px;" placeholder="Search for..."
									aria-label="Search" aria-describedby="basic-addon2">
								<div class="input-group-append">
									<button class="btn btn-primary" id="searchButton" data-toggle="modal" data-target="#searchResultBox">
										<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</form>
						<div class="cart">
							<a class="nav-link" href="#" data-toggle="modal" data-target="#cart"><span class="m-cart badge badge-pill badge-danger position-absolute" id="cartCount"><?php echo $carts->num_rows; ?></span><i class="fas fa-fw fa-shopping-cart"></i>  Giỏ hàng</i></a>
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
							function formatCurrency($amount) {
								return number_format($amount, 0, ',', '.') . ' đ';
							}
							// Lặp qua mỗi sản phẩm và hiển thị chúng
							foreach ($products as $product) {
								echo '<div class="col-md-2 mb-4">
									<div class="card">
										<img src="' . $product['image'] . '" class="card-img-top zoom-img" style="height: 120px" alt="Product Image">
										<div class="card-body">
											<h5 class="card-title">' . $product['name'] . '</h5>
											<p class="card-text text-truncate">' . $product['description'] . '</p>
											<p class="card-text">Kho: ' . $product['stock'] . '</p>
											<p class="card-text ">Giá: <span class="text-danger">' . formatCurrency($product['price']) . '</span></p>
											<div class="text-center d-flex">
												<a class="btn btn-primary mr-3" onclick="addCart('.$product['product_id'].','.$_SESSION['user_id'].')">Thêm Vào Giỏ</a>
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
			<footer class="sticky-footer bg-info">
				<div class="container text-white">
					<div class="row">
						<!-- Footer Location-->
						<div class="col-lg-4 mb-5 mb-lg-0">
							<h4 class="text-uppercase mb-4">Location</h4>
							<p class="lead mb-0">
								2215 John Daniel Drive
								<br />
								Clark, MO 65243
							</p>
						</div>
						<!-- Footer Social Icons-->
						<div class="col-lg-4 mb-5 mb-lg-0">
							<h4 class="text-uppercase mb-4">Around the Web</h4>
							<a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
							<a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-google"></i></a>
							<a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
							<a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
						</div>
						<!-- Footer About Text-->
						<div class="col-lg-4">
							<h4 class="text-uppercase mb-4">About Freelancer</h4>
							<p class="lead mb-0">
								Freelance is a free to use, MIT licensed Bootstrap theme created by
								<a href="http://startbootstrap.com">Start Bootstrap</a>.
							</p>
						</div>
					</div>
				</div>
				<!-- Copyright Section-->
				<div class="copyright py-4 text-center text-white">
					<div class="container"><small>Copyright &copy; Your Website 2023</small></div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->
	<div class="modal fade" id="searchResultBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Kết quả tìm kiếm</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- Form bắt đầu ở đây -->
					<div id="searchResult"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered mw" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Giỏ Hàng</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th style="width: 140px">Image</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($carts->rows as $value) {
								echo '<tr>
									<td>'.$value['name'].'</td>
									<td>
										<img src="'.$value['image'].'" 	class="menu-img w-75" alt="" style="height: 60px">
									</td>
									<td class="text-danger">
										'.formatCurrency($value['price']).'
									</td>
									<td class="d-flex align-items-baseline">
										<a type="button" onclick="minus(this)">
											<i class="fas fa-minus-circle"></i>
										</a>
										<p class="quantity mx-3">'.$value['quantity'].'</p>
										<a type="button" onclick="plus(this)">
											<i class="fas fa-plus-circle"></i>
										</a>
									</td>
									<td class="text-danger total-price">
										'.formatCurrency($value['price']*$value['quantity']).'
									</td>
									<td class="text-center">
										<a type="button" onclick="removeItem(this, \'/destroy-cart/'.$value['cart_item_id'].'\', '.$_SESSION['user_id'].')">
											<i class="fas fa-trash"></i>
										</a>
									</td>
								</tr>';
							}
						?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>
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