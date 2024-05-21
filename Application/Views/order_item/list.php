<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" type="image/x-icon" href="public/assets/img/logo.jpg">
    <title>Pos Coron - Order Item List</title>

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
								<table class="table">
									<thead>
										<tr>
											<th style="width: 50px">ID</th>
											<th>Product</th>
											<th>Quantity</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (isset($values) && !empty($values)) {
											foreach($values as $value) {
												echo '<tr>
													<td>'.$value['order_item_id'].'</td>
													<td>'.$value['name'].'</td>
													<td>'.$value['quantity'].'</td>
													<td>'.$value['price'].'</td>
												</tr>';
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>

					</div>

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