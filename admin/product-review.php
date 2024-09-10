<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

require "../MySQL.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>GreenWay - Product Review</title>

    <!-- Theme js -->
    <script type="module" async src="assets/js/theme.js"></script>

    <!-- Google font-->
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="assets/css/linearicon.css">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">

    <!-- Feather icon css -->
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

</head>

<body>
<!-- tap on top start-->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end-->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include 'header.php'; ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include 'sidebar.php'; ?>
        <!-- Page Sidebar Ends-->

        <!-- product review section start -->
        <div class="page-body">
            <div class="title-header">
                <div>
                    <h5>Product Reviews</h5>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <?php

                            $page = $_GET["page"] ?? 1;

                            $reviewsRs = MySQL::search("SELECT * FROM reviews JOIN product p on reviews.product_id = p.id ORDER BY date_added DESC");
                            $noOfReviews = $reviewsRs->num_rows;
                            $resultsPerPage = 10;
                            $noOfPages = ceil($noOfReviews / $resultsPerPage);
                            $viewedResultsCount = ($page - 1) * $resultsPerPage;
                            $reviewsRs = MySQL::search("SELECT * FROM reviews JOIN product p on p.id = reviews.product_id ORDER BY date_added DESC LIMIT $resultsPerPage OFFSET $viewedResultsCount");
                            ?>
                            <!-- Table Start -->
                            <div class="card-body">
                                <div>
                                    <div class="table-responsive table-desi">
                                        <table class="user-table ticket-table review-table table table-striped">
                                            <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while ($review = $reviewsRs->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td><?= $review["id"] ?></td>
                                                    <td><?= $review["user_email"] ?></td>
                                                    <td><?= $review["title"] ?></td>
                                                    <td>
                                                        <ul class="rating">
                                                            <?php
                                                            for ($i = 1; $i <= 5; $i++) {
                                                               if($review["rating"] >= $i) {
                                                                   echo "<li><i class='fas fa-star theme-color'></i></li>";
                                                               }else {
                                                                   echo "<li><i class='fas fa-star'></i></li>";
                                                               }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </td>
                                                    <td><?= $review["review"] ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Table End -->

                            <!-- Pagination Box Start -->
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
                            <!-- Pagination Box End -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Container-fluid Ends-->

            <div class="container-fluid">
                <!-- footer start-->
                <?php include 'footer.php'; ?>
                <!-- footer end-->
            </div>
        </div>
        <!-- product review section End -->
    </div>
    <!-- Page Body end-->
</div>
<!-- page-wrapper end-->

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

<!-- Plugins JS -->
<script src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/notify/bootstrap-notify.min.js"></script>
<script src="assets/js/notify/index.js"></script>

<!-- all checkbox select js -->
<script src="assets/js/checkbox-all-check.js"></script>

<!-- Theme js -->
<script src="assets/js/script.js"></script>
</body>


<!-- Mirrored from themes.pixelstrap.com/voxo/back-end/product-review.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 05 Nov 2022 07:43:05 GMT -->
</html>