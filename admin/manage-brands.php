<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

require "../MySQL.php";

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>GreenWay - Brands List</title>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="assets/css/linearicon.css">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

    <!-- Theme js -->
    <script type="module" async src="assets/js/theme.js"></script>
</head>

<body>
<!-- tap on top start -->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end -->

<!-- page-wrapper Start -->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">
    <!-- Page Header Start -->
    <?php include_once('header.php'); ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include_once('sidebar.php'); ?>
        <!-- Page Sidebar Ends-->

        <!-- vendor List Section Start -->
        <div class="page-body">
            <div class="title-header title-header-1">
                <h5>Brand List</h5>
                <form class="d-inline-flex">
                    <a href="add-new-product.php" type="button" class="align-items-center btn btn-primary d-flex gap-2">
                        <i data-feather="plus-square"></i>Add New brand
                    </a>
                </form>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">

                            <?php
                            $page = $_GET['page'] ?? 1;

                            $brandsRs = MySQL::search("SELECT * FROM brand");
                            $noOfCategories = $brandsRs->num_rows;
                            $itemsPerPage = 10;
                            $noOfPages = ceil($noOfCategories / $itemsPerPage);
                            $offset = ($page - 1) * $itemsPerPage;
                            $brandsRs = MySQL::search("SELECT * FROM brand LIMIT $itemsPerPage OFFSET $offset");

                            ?>

                            <!-- Table Start -->
                            <div class="card-body">
                                <div class="table-responsive table-desi">
                                    <table class="table table-striped all-package">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>brand</th>
                                            <th>No of Products</th>
                                            <th>Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        if ($brandsRs->num_rows == 0) {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Something Went Wrong!</td>
                                            </tr>
                                            <?php
                                        } else {

                                            while ($brand = $brandsRs->fetch_assoc()) {
                                                $productsRs = MySQL::search("SELECT * FROM product WHERE brand_id = '{$brand['id']}'");
                                                ?>

                                                <tr>
                                                    <td><?php echo $brand['id']; ?></td>
                                                    <td><?php echo $brand['brand']; ?></td>
                                                    <td>
                                                        <span class="badge badge-light-danger"><?php echo $productsRs->num_rows; ?></span>
                                                    </td>
                                                    <td>
                                                        <ul>

                                                            <li>
                                                                <a href="javascript:showUpdatebrandModal('<?= $brand['id'] ?>')">
                                                                    <span class="lnr lnr-pencil"></span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:deleteBrand('<?= $brand['id'] ?>');">
                                                                    <span class="lnr lnr-trash"></span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Table End -->

                            <!-- Pagination Start -->
                            <div class="pagination-box">
                                <nav class="ms-auto me-auto " aria-label="...">
                                    <ul class="pagination pagination-primary">
                                        <li class="page-item <?= ($page <= 1) ? "disabled" : "" ?>">
                                            <a class="page-link"
                                               href="?page=<?= ($page - 1 > 0) ? $page - 1 : $page ?>">Previous</a>
                                        </li>
                                        <?php

                                        for ($x = 1; $x <= $noOfPages; $x++) {
                                            ?>
                                            <li class="page-item <?= ($x == $page) ? "active" : "" ?>">
                                                <a class="page-link" href="?page=<?= $x ?>"><?= $x ?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                        <li class="page-item <?= ($page >= $noOfPages) ? "disabled" : "" ?>">
                                            <a class="page-link"
                                               href="?page=<?= ($page + 1 <= $noOfPages) ? $page + 1 : $page ?>">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Pagination End -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
            <?php include 'footer.php'; ?>
            <!-- Footer End -->
        </div>
        <!-- vendor List Section End -->
    </div>
    <!-- Page Body Start-->
</div>
<!-- page-wrapper End-->

<!-- Update Modal -->
<div class="modal fade" id="updateBrandModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Update Brand</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4 row align-items-center">
                    <div class="col-sm-12">
                        <div class="theme-form theme-form-2 mega-form">
                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label form-label-title">ID</label>
                                <input class="form-control" type="text" placeholder="#123"
                                       id="updatedBrandId" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label form-label-title">Brand</label>
                                <input class="form-control" type="text" placeholder="brand name"
                                       id="updatedBrand">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" onclick="updateBrand()">Update brand</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab Contents -->
            </div>
        </div>
    </div>
</div>
<!-- Update Modal -->

<!-- latest js -->
<script src="assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap js -->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- feather icon js -->
<script src="assets/js/icons/feather-icon/feather.min.js"></script>
<script src="assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- scrollbar simplebar js -->
<script src="assets/js/scrollbar/simplebar.js"></script>
<script src="assets/js/scrollbar/custom.js"></script>

<!-- customizer js -->
<script src="assets/js/customizer.js"></script>

<!-- Sidebar js -->
<script src="assets/js/config.js"></script>

<!-- Plugins js -->
<script src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/notify/bootstrap-notify.min.js"></script>
<script src="assets/js/notify/index.js"></script>

<!-- all checkbox select js -->
<script src="assets/js/checkbox-all-check.js"></script>

<!-- Theme js -->
<script src="assets/js/script.js"></script>
<script src="assets/js/admin.js"></script>

</body>
</html>