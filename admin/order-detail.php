<?php
require '../MySQL.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

if (!isset($_GET['invoice'])) {
    header("Location: ../404.php");
}

$invoiceId = $_GET['invoice'];

$invoiceRs = MySQL::search("SELECT * FROM invoice WHERE invoice_id = '$invoiceId'");
if ($invoiceRs->num_rows == 0) {
    echo "No invoice found";
    exit();
}
$invoice = $invoiceRs->fetch_assoc();

$invoiceItemsRs = MySQL::search("SELECT *, invoice_item.qty as qty FROM invoice_item JOIN product p on invoice_item.product_id = p.id WHERE invoice_invoice_id = '$invoiceId'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>GreenWay - Order Details</title>

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
<!-- tap on top start -->
<div class="tap-top">
    <i data-feather="chevrons-up"></i>
</div>
<!-- tap on tap end -->

<!-- page-wrapper Start -->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include 'header.php'; ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include 'sidebar.php'; ?>
        <!-- Page Sidebar Ends-->

        <!-- tracking section start -->
        <div class="page-body">
            <div class="title-header title-header-block package-card">
                <div>
                    <h5>Order #<?= $invoiceId ?></h5>
                </div>
                <div class="card-order-section">
                    <ul>
                        <!--<li>October 21, 2021 at 9:08 pm</li>-->
                        <li><?= date("M d, H:i a") ?></li>
                        <li><?= $invoiceItemsRs->num_rows ?> Items</li>
                        <li>Total Rs.<?= $invoice["amount"] ?></li>
                    </ul>
                </div>
            </div>

            <!-- tracking table start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="bg-inner cart-section order-details-table">
                                    <div class="row g-4">
                                        <div class="col-xl-8">
                                            <div class="table-responsive table-details">
                                                <table class="table cart-table table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="4">Items</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php
                                                    $subTotal = 0;
                                                    while ($invoiceItem = $invoiceItemsRs->fetch_assoc()) {
                                                        $subTotal+= $invoiceItem["qty"] * $invoiceItem["price"];
                                                        ?>
                                                        <tr class="table-order">
                                                            <td>
                                                                <a href="javascript:void(0)">
                                                                    <?php
                                                                    $productImages = MySQL::search("SELECT * FROM product_images WHERE product_id = '" . $invoiceItem["product_id"] . "'");
                                                                    if ($productImages->num_rows > 0) {
                                                                        $productImage = $productImages->fetch_assoc();
                                                                        ?>
                                                                        <img src="../<?= $productImage["code"] ?>"
                                                                             class="img-fluid blur-up lazyload" alt="">
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <p>Product Name</p>
                                                                <h5><?= $invoiceItem["title"] ?></h5>
                                                            </td>
                                                            <td>
                                                                <p>Quantity</p>
                                                                <h5><?= $invoiceItem["qty"] ?></h5>
                                                            </td>
                                                            <td>
                                                                <p>Price</p>
                                                                <h5>Rs.<?= $invoiceItem["qty"] * $invoiceItem["unit_price"] ?><div class="00"></div></h5>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }

                                                    ?>

                                                    </tbody>

                                                    <tfoot>
                                                    <tr class="table-order">
                                                        <td colspan="3">
                                                            <h5>Subtotal :</h5>
                                                        </td>
                                                        <td>
                                                            <h4>Rs.<?= $subTotal ?></h4>
                                                        </td>
                                                    </tr>

                                                    <tr class="table-order">
                                                        <td colspan="3">
                                                            <h5>Shipping :</h5>
                                                        </td>
                                                        <td>
                                                            <h4>Rs.<?= $invoice["amount"] - $subTotal ?></h4>
                                                        </td>
                                                    </tr>

                                                    <tr class="table-order">
                                                        <td colspan="3">
                                                            <h4 class="theme-color fw-bold">Total Price :</h4>
                                                        </td>
                                                        <td>
                                                            <h4 class="theme-color fw-bold">Rs.<?= $invoice['amount'] ?></h4>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="order-success">
                                                <div class="row g-4">
                                                    <h4>summary</h4>
                                                    <ul class="order-details">
                                                        <li>Order ID: <?= $invoiceId ?></li>
                                                        <li>Order Date: <?= date("M d, Y", strtotime($invoice['date'])) ?></li>
                                                        <li>Order Total: Rs.<?= $invoice["amount"] ?></li>
                                                    </ul>

                                                    <div class="delivery-sec">
                                                        <h3>expected date of delivery:<span><?= date("M d, y h:i A", strtotime($invoice["date"])) ?></span></h3>
                                                        <a href="javascript:void(0)">Track order</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- section end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tracking table end -->

            <div class="container-fluid">
                <!-- footer start-->
                <?php include "footer.php"; ?>
            </div>
        </div>
        <!-- tracking section End -->
    </div>
</div>
<!-- page-wrapper End -->

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

<!-- customizer js -->
<script src="assets/js/customizer.js"></script>

<!-- Plugins js -->
<script src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/notify/bootstrap-notify.min.js"></script>
<script src="assets/js/notify/index.js"></script>

<!-- Theme js -->
<script src="assets/js/script.js"></script>
</body>

</html>