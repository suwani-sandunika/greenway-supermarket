<?php
require "MySQL.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: unauthorized.php");
    exit();
}

if (!isset($_GET['order'])) {
    header("Location: 404.php");
    exit();
}

$userEmail = $_SESSION['user'];

$invId = $_GET['order'];

$invRs = MySQL::search("SELECT * FROM invoice WHERE invoice_id='$invId' AND user_email='${userEmail}'");
if ($invRs->num_rows <= 0) {
    header("Location: 404.php");
    exit();
}

$invData = $invRs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <title>GreenWay - Order Success</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

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
<!-- mobile fix menu end -->

<!-- Order Success Section Start -->
<section class="pt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="success-icon">
                    <div class="main-container">
                        <div class="check-container">
                            <div class="check-background">
                                <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="check-shadow"></div>
                        </div>
                    </div>

                    <div class="success-contain">
                        <h4>Order Success</h4>
                        <h5 class="font-light">Payment Is Successfully Processsed And Your Order Is On The Way</h5>
                        <h6 class="font-light">Transaction ID:<?= $invData['invoice_id'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Success Section End -->

<!-- Oder Details Section Start -->
<section class="section-b-space cart-section order-details-table">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="title title1 title-effect mb-1 title-left">
                    <h2 class="mb-3">Order Details</h2>
                </div>
            </div>
            <div class="col-6 text-end">
                <a href="invoice.php?invoice=<?= $invId ?>" class="btn btn-solid-dark rounded-2">print invoice</a>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="col-sm-12 table-responsive">
                    <table class="table cart-table table-borderless">
                        <tbody>
                        <?php

                        $invItemsRs = MySQL::search("SELECT *, p.id as pid, invoice_item.qty as inv_qty FROM invoice_item JOIN product p on invoice_item.product_id = p.id JOIN brand b on p.brand_id = b.id WHERE invoice_invoice_id='$invId'");
                        while ($invItem = $invItemsRs->fetch_assoc()) {
                            ?>
                            <!--product start-->
                            <tr class="table-order">
                                <td>
                                    <a href="javascript:void(0)">

                                        <?php
                                        $imagesRs = MySQL::search("SELECT * FROM product_images WHERE product_id='${invItem['pid']}'");
                                        $image = $imagesRs->fetch_assoc();
                                        ?>
                                        <img src="<?= $image['code'] ?>"
                                             class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </td>
                                <td>
                                    <p><?= $invItem['title'] ?></p>
                                    <h5><?= $invItem['brand'] ?></h5>
                                </td>
                                <td>
                                    <p>Quantity</p>
                                    <h5><?= $invItem['inv_qty'] ?></h5>
                                </td>
                                <td>
                                    <p>Unit Price</p>
                                    <h5>Rs.<?= $invItem['unit_price'] ?></h5>
                                </td>
                            </tr>
                            <!--product end-->
                            <?php
                        }

                        ?>
                        </tbody>
                        <tfoot>
                        <tr class="table-order">
                            <td colspan="3">
                                <h5 class="font-light">Subtotal :</h5>
                            </td>
                            <td>
                                <h4>Rs.<?= ($invData['amount'] - $invData['delivery_fee']) ?></h4>
                            </td>
                        </tr>

                        <tr class="table-order">
                            <td colspan="3">
                                <h5 class="font-light">Shipping :</h5>
                            </td>
                            <td>
                                <h4>Rs.<?= $invData['delivery_fee'] ?></h4>
                            </td>
                        </tr>

                        <tr class="table-order">
                            <td colspan="3">
                                <h4 class="theme-color fw-bold">Total Price :</h4>
                            </td>
                            <td>
                                <h4 class="theme-color fw-bold">Rs.<?= $invData['amount'] ?></h4>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="order-success">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <h4>summery</h4>
                            <ul class="order-details">
                                <li>Order ID: <?= $invData['invoice_id'] ?></li>
                                <li>Order Date: <?= date_format(date_create($invData['date']), "M d, Y") ?></li>
                                <li>Order Total: Rs.<?= $invData['amount'] ?></li>
                            </ul>
                        </div>

                        <div class="col-sm-6">
                            <h4>shipping address</h4>
                            <ul class="order-details">
                                <?php
                                $addressRs = MySQL::search("SELECT * FROM address JOIN city c on c.id = address.city_id WHERE user_email='${invData['user_email']}'");
                                $addressData = $addressRs->fetch_assoc();
                                ?>
                                <li><?= $addressData['line1'] ?></li>
                                <li><?= $addressData['line2'] ?></li>
                                <li><?= $addressData['city'] . ', ' . $addressData['postal_code'] ?></li>
                            </ul>
                        </div>

                        <div class="col-12">
                            <div class="payment-mode">
                                <h4>payment method</h4>
                                <p>Card Payment. Paid through stripe...</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="delivery-sec">
                                <?php
                                $date = date_format(date_create($invData['date']), "M d, Y");
                                $date = strtotime($date);
                                $date = strtotime("+7 day", $date);
                                ?>
                                <h3>expected date of delivery: <span><?= date('M d, Y', $date) ?></span></h3>
                                <a href="javascript:void(0)">track order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Details Section End -->

<!-- Subscribe Section Start -->
<section class="subscribe-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="subscribe-details">
                    <h2 class="mb-3">Subscribe Our News</h2>
                    <h6 class="font-light">Subscribe and receive our newsletters to follow the news about our fresh
                        and fantastic Products.</h6>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
                <div class="subsribe-input">
                    <div class="input-group">
                        <input type="text" class="form-control subscribe-input" placeholder="Your Email Address">
                        <button class="btn btn-solid-default" type="button">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Subscribe Section End -->

<!-- footer start -->
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

<!-- Notify js-->
<script src="assets/js/bootstrap/bootstrap-notify.min.js"></script>

<!-- script js -->
<script src="assets/js/script.js"></script>
</body>

</html>