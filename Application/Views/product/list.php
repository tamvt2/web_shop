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
											<th>Name</th>
											<th style="width: 250px">Description</th>
											<th>Price</th>
											<th>Stock</th>
											<th>Category name</th>
											<th>Image</th>
											<th style="width: 100px">&nbsp</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($values as $value) {
												echo '<tr>
													<td>'.$value['product_id'].'</td>
													<td>'.$value['name'].'</td>
													<td>'.$value['description'].'</td>
													<td>'.$value['price'].'</td>
													<td>'.$value['stock'].'</td>
													<td>'.$value['category_name'].'</td>
													<td><img src="'.$value['image'].'" 	class="menu-img" alt="" style="width: 40%; height: 60px"></td>
													<td>
														<a type="button" class="btn btn-warning btn-sm mb-1" href="/update-product/'.$value['product_id'].'">Sửa</a>
														<a type="button" class="btn btn-danger btn-sm" onclick="removeRow('.$value['product_id'].', \'/destroy-product/\')">Xóa</a>
													</td>
												</tr>';
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