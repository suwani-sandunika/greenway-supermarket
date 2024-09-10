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
    <title>GreenWay - Order List</title>

    <!-- Theme js -->
    <script type="module" async src="assets/js/theme.js"></script>

    <!-- Google font-->
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- Linear Icon -->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

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
        <?php include "sidebar.php"; ?>
        <!-- Page Sidebar Ends-->

        <!-- Order section Start -->
        <div class="page-body">
            <div class="title-header">
                <h5>Order List</h5>
            </div>

            <!-- Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-3">
                                        <span>Search : </span>
                                        <input id="searchTextInvoice" type="text" class="form-control"
                                               placeholder="Invoice Id / Email Address" onkeyup="searchInvoice(1)">
                                    </div>
                                </div>
                            </div>

                            <?php
                            $page = $_GET["page"] ?? 1;

                            $invoiceRs = MySQL::search("SELECT * FROM invoice");
                            $noOfInvoices = $invoiceRs->num_rows;
                            $resultsPerPage = 10;
                            $noOfPages = ceil($noOfInvoices / $resultsPerPage);
                            $viewedCount = ($page - 1) * $resultsPerPage;
                            $invoiceRs = MySQL::search("SELECT * FROM invoice LIMIT $resultsPerPage OFFSET $viewedCount");

                            ?>

                            <div class="d-flex justify-content-center flex-column" id="searchResults">
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-desi">
                                            <table class="table table-striped all-package">
                                                <thead>
                                                <tr>
                                                    <th>Invoice ID</th>
                                                    <th>User Email</th>
                                                    <th>Date</th>
                                                    <th>Delivery Status</th>
                                                    <th>Amount</th>
                                                    <th>Option</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php

                                                if ($invoiceRs->num_rows == 0) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Something Went Wrong!</td>
                                                    </tr>
                                                    <?php
                                                } else {

                                                    while ($invoice = $invoiceRs->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td>#<?= $invoice["invoice_id"] ?></td>

                                                            <td><?= $invoice["user_email"] ?></td>

                                                            <td><?= date("d M, Y H:i", strtotime($invoice["date"])) ?></td>

                                                            <?php

                                                            switch ($invoice["status"]) {
                                                                case 0:
                                                                    ?>
                                                                    <td class="order-pending">
                                                                        <span>Pending</span>
                                                                    </td>
                                                                    <?php
                                                                    break;
                                                                case 1:
                                                                    ?>
                                                                    <td class="order-success">
                                                                        <span>Processing</span>
                                                                    </td>
                                                                    <?php
                                                                    break;
                                                                case 2:
                                                                    ?>
                                                                    <td class="order-success">
                                                                        <span>Completed</span>
                                                                    </td>
                                                                    <?php
                                                                    break;
                                                                case 3:
                                                                    ?>
                                                                    <td class="order-cancle">
                                                                        <span>Cancelled</span>
                                                                    </td>
                                                                    <?php
                                                                    break;
                                                                default:
                                                                    ?>
                                                                    <td class="order-pending">
                                                                        <span>Pending</span>
                                                                    </td>
                                                                <?php
                                                            }
                                                            ?>

                                                            <td>Rs.<?= $invoice["amount"] ?></td>

                                                            <td>
                                                                <ul>
                                                                    <li>
                                                                        <a href="order-detail.php?invoice=<?= $invoice["invoice_id"] ?>">
                                                                            <span class="lnr lnr-eye"></span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:showStatusUpdateModal('<?= $invoice["invoice_id"] ?>', '<?= $invoice["status"] ?>')">
                                                                            <span class="lnr lnr-arrow-up-circle"></span>
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
                                </div>

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
            </div>
            <!-- Table End -->

            <!-- footer start-->
            <?php include 'footer.php'; ?>
            <!-- footer End-->

        </div>
        <!-- Order section End -->
    </div>
    <!-- Page Body End-->
</div>
<!-- page-wrapper End -->

<!-- Modal start -->
<div class="modal fade" id="updateOrderStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel">Update Order Status</h5>
                <form>
                    <div class="mb-3">
                        <input id="invId" type="text" placeholder="Invoice Id" class="form-control"></input>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="invStatus">
                            <option value="-1" disabled>Status Menu</option>
                            <option value="0">Pending</option>
                            <option value="1">Processing</option>
                            <option value="2">Completed</option>
                            <option value="3">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-2 text-end">
                        <button type="button" class="btn btn-primary" onclick="updateOrderStatus()">Update</button>
                    </div>
                </form>
                <!--<p>Are you sure you want to log out?</p>-->
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                <!--<div class="button-box">-->
                <!--    <button type="button" class="btn btn--no " data-bs-dismiss="modal">No</button>-->
                <!--    <button type="button" class="btn  btn--yes btn-primary">Yes</button>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<!-- latest js -->
<script src="assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap js -->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- feather icon js -->
<script src="assets/js/icons/feather-icon/feather.min.js"></script>
<script src="assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- customizer js -->
<script src="assets/js/customizer.js"></script>

<!-- scrollbar simplebar js -->
<script src="assets/js/scrollbar/simplebar.js"></script>
<script src="assets/js/scrollbar/custom.js"></script>

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