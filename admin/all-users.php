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
    <title>GreenWay- All Users</title>
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

    <!-- Theme js -->
    <script type="module" async src="assets/js/theme.js"></script>
</head>

<body>
<!-- tap on top start -->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end -->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include 'header.php'; ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start -->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include 'sidebar.php'; ?>
        <!-- Page Sidebar Ends-->

        <!-- Container-fluid starts-->
        <div class="page-body">
            <div class="title-header title-header-1">
                <h5>All Users</h5>
                <form class="d-inline-flex">
                    <input id="userSearchText" type="text" placeholder="search" class="form-control" onkeyup="searchUsers();"/>
                    <!--<a href="add-new-user.php" class="align-items-center btn btn-primary d-flex gap-2">-->
                    <!--    <i data-feather="plus-square"></i>Add New-->
                    <!--</a>-->
                </form>
            </div>
            <!-- All User Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card" id="searchResults">
                            <?php
                            $page = $_GET['page'] ?? 1;

                            $adminsRs = MySQL::search("SELECT fname, lname, email, mobile, create_time, status_id, s.status FROM admin JOIN status s on admin.status_id = s.id");
                            $noOfAdmins = $adminsRs->num_rows;
                            $resultsPerPage = 10;
                            $noOfPages = ceil($noOfAdmins / $resultsPerPage);
                            $viewedPages = ($page - 1) * $resultsPerPage;

                            $adminsRs = MySQL::search("SELECT fname, lname, email, mobile, create_time, status_id, s.status FROM admin JOIN status s on admin.status_id = s.id LIMIT $resultsPerPage OFFSET $viewedPages");
                            ?>

                            <div class="card-body">
                                <div>
                                    <div class="table-responsive table-desi">
                                        <table class="table table-striped all-package">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($adminsRs->num_rows == 0) {
                                                ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Something Went Wrong!</td>
                                                </tr>
                                                <tr></tr>
                                                <tr></tr>
                                                <tr></tr>
                                                <tr></tr>
                                                <tr></tr>

                                                <?php
                                            } else {
                                                while ($admin = $adminsRs->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                        <span class="d-flex align-items-center justify-content-center">
                                                            <div class="form-check form-switch"
                                                                 style="width: fit-content">
                                                                <input type="checkbox" class="form-check-input"
                                                                       role="switch" <?= (strtolower($admin["status"]) == "active") ? "checked" : "" ?>>
                                                            </div>
                                                        </span>
                                                        </td>

                                                        <td class="d-flex align-items-center justify-content-center">
                                                            <a href="javascript:void(0)">
                                                                <span class="d-block "><?= $admin['fname'] . ' ' . $admin['lname'] ?></span>
                                                                <span>USER</span>
                                                            </a>
                                                        </td>

                                                        <td><?= $admin['mobile'] ?></td>

                                                        <td><?= $admin['email'] ?></td>

                                                        <td><?= date("d M, Y H:i ", strtotime($admin["create_time"])) ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

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

                        </div>
                    </div>
                </div>
            </div>
            <!-- All User Table Ends-->

            <div class="container-fluid">
                <!-- footer start-->
                <?php include 'footer.php'; ?>
                <!-- footer end-->
            </div>
        </div>
        <!-- Container-fluid end -->
    </div>
    <!-- Page Body End -->

    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no " data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn  btn--yes btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
</div>

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

<!-- Sidebar js -->
<script src="assets/js/config.js"></script>

<!-- Plugins JS -->
<script src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/notify/bootstrap-notify.min.js"></script>
<script src="assets/js/notify/index.js"></script>

<!-- Theme js -->
<script src="assets/js/script.js"></script>
<script src="assets/js/admin.js"></script>
</body>
</html>