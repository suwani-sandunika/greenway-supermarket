<?php

require_once "MySQL.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: unauthorized.php");
    exit();
}

$userEmail = $_SESSION['user'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <title>GreenWay - Order History</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">

    <!-- animation css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick/slick-theme.css">

    <!-- Theme css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="assets/css/theme.css">
</head>
<body class="theme-color6 light ltr">
<!-- header start -->
<?php require "header.php"; ?>
<!-- header end -->

<!-- mobile fix menu start -->
<?php require "mobile-fix-menu.php"; ?>
<!-- mobile fix menu start -->

<!-- Breadcrumb section start -->
<section class="breadcrumb-section section-b-space">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Order History</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Order History</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb section end -->

<section class="section-b-space">
    <div class="container">
        <div class="col-12 p-3">
            <div class="box-head mb-3">
                <h3>ORDER HISTORY</h3>
            </div>
            <div class="table-responsive">
                <table class="table cart-table">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">Order Id</th>
                        <th scope="col">Date Purchased</th>
                        <th scope="col">Delivery Fee</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $invoiceRs = MySQL::search("SELECT * FROM `invoice` WHERE user_email='$userEmail'");
                    while ($invoiceData = $invoiceRs->fetch_assoc()) {

                        ?>
                        <tr>
                            <td>
                                <p class="mt-0"><?= $invoiceData['invoice_id'] ?></p>
                            </td>
                            <td>
                                <p class="fs-6 m-0"><?= date("d M Y H:i:s", strtotime($invoiceData['date'])) ?></p>
                            </td>
                            <td>
                                <p class="mt-0">Rs.<?= $invoiceData['delivery_fee'] ?></p>
                            </td>
                            <td>
                                <p class="mt-0">Rs.<?= $invoiceData['amount'] ?></p>
                            </td>
                            <td>

                                <?php

                                switch ($invoiceData["status"]) {
                                    case 0:
                                        echo '<p class="badge bg-secondary text-white">Pending</p>';
                                        break;
                                    case 1:
                                        echo '<p class="badge bg-warning">Processing</p>';
                                        break;
                                    case 2:
                                        echo '<p class="badge bg-success text-white">Completed</p>';
                                        break;
                                    case 3:
                                        echo '<p class="badge bg-danger text-white">Cancelled</p>';
                                        break;
                                    default:
                                        echo '<p class="badge bg-secondary text-white">Pending</p>';
                                }
                                ?>

                            </td>
                            <td>
                                <a href="javascript:loadInvoiceProducts('<?= $invoiceData['invoice_id'] ?>');">
                                    <i class="far fa-eye"></i>
                                </a>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--BODY-->


<!-- view products modal start -->
<div class="modal fade reset-email-modal" id="invoiceProductsModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Update Address</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-3">
                <div class="table-responsive">
                    <table class="table cart-table">
                        <thead>
                        <tr class="table-head">
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody id="invoiceProducts">

                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer pt-0">
                <button class="btn bg-secondary rounded-1 modal-close-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- view products modal end -->

<!--  footer start -->
<?php require "footer.php"; ?>
<!-- footer end -->

<!-- tap to top Section Start -->
<div class="tap-to-top">
    <a href="#home">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- tap to top Section End -->

<div class="bg-overlay"></div>

<!-- latest jquery-->
<script src="assets/js/jquery-3.5.1.min.js"></script>

<!-- Bootstrap js-->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="assets/js/feather/feather.min.js"></script>

<!-- lazyload js-->
<script src="assets/js/lazysizes.min.js"></script>

<!-- Slick js-->
<script src="assets/js/slick/slick.js"></script>
<script src="assets/js/slick/slick-animation.min.js"></script>
<script src="assets/js/slick/custom_slick.js"></script>

<!-- ajax search js -->
<script src="assets/js/typeahead.bundle.min.js"></script>
<script src="assets/js/typeahead.jquery.min.js"></script>
<script src="assets/js/ajax-custom.js"></script>

<!-- Notify js-->
<script src="assets/js/bootstrap/bootstrap-notify.min.js"></script>

<!-- script js -->
<script src="assets/js/script.js"></script>
<script src="assets/js/customer.js"></script>

</body>
</html>