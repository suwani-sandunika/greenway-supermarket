<?php
require "MySQL.php";
session_start();

if (!isset($_GET['invoice'])) {
    header("Location: 404.php");
    exit();
}

$invId = $_GET['invoice'];
$invRs = MySQL::search("SELECT * FROM invoice WHERE invoice_id='$invId'");
if ($invRs->num_rows <= 0) {
    exit();
}
$invData = $invRs->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Greenway | Invoice</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/theme.css">


</head>

<body class="theme-color6 bg-light" onload="window.print()">

<!-- invoice start -->
<section class="theme-invoice-4 section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 m-auto">
                <div class="invoice-wrapper">
                    <div class="invoice-header">
                        <span class="greenway fw-bolder fs-5">GreenWay Supermarket</span>
                    </div>
                    <div class="invoice-body">
                        <div class="top-sec">
                            <div class="row">
                                <div class="col-xxl-8 col-md-7">
                                    <div class="address-detail">
                                        <div class="mt-2">
                                            <h4 class="mb-2">102/1</h4>
                                            <h4 class="mb-2">Havelock road</h4>
                                            <h4 class="mb-0">Colombo</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-5">
                                    <div class="address-detail">
                                        <div class="mt-2">
                                            <h4 class="mb-2 theme-color">Issue Date : <span
                                                        class="text-contact"><?= date_format(date_create($invData['date']), 'M, d Y') ?></span>
                                            </h4>

                                            <h4 class="mb-2 theme-color">Invoice no : <span
                                                        class="text-contact"><?= $invId ?></span></h4>

                                            <h4 class="mb-0 theme-color">Email : <span
                                                        class="text-contact"><?= $invData['user_email'] ?></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title-sec">
                            <h2 class="title">invoice</h2>
                            <div class="row">
                                <div class="col-6">
                                    <a href="#" class="btn btn-solid-default rounded-2"
                                       onclick="window.print();">export
                                        as PDF</a>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-solid-dark rounded-2"
                                       onclick="window.print();">print</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-sec">
                            <div class="table-responsive-md">
                                <table class="table table-borderless table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">description</th>
                                        <th scope="col">price</th>
                                        <th scope="col">hrs.</th>
                                        <th scope="col">total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $invItemsRs = MySQL::search("SELECT *, invoice_item.qty as cqty FROM invoice_item JOIN product p on p.id = invoice_item.product_id WHERE invoice_invoice_id='$invId'");
                                    $x = 1;
                                    while ($invItem = $invItemsRs->fetch_assoc()) {

                                        ?>
                                        <tr>
                                            <th scope="row"><?= $x ?></th>
                                            <td><?= $invItem['title'] ?></td>
                                            <td>Rs.<?= $invItem['price'] ?></td>
                                            <td><?= $invItem['cqty'] ?></td>
                                            <td>Rs.<?= $invItem['price'] * $invItem['cqty'] ?></td>
                                        </tr>
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-end">
                                <div class="table-footer">
                                    <span class="me-5 font-bold">Grand Total</span>
                                    <span class="font-bold">Rs.<?= $invData['amount'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-footer">
                        <!-- <img src="assets/images/invoice/shape.png" class="img-fluid design-shape" alt=""> -->
                        <ul>
                            <li>
                                <i class="fa fa-map"></i>
                                <div>
                                    <h4>102/A Havelock road,</h4>
                                    <h4>Colombo, 0007</h4>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <div>
                                    <h4>+94 76 893 2131</h4>
                                    <h4>+94 71 334 9742</h4>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div>
                                    <h4>support@greenway.com</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- invoice end -->
</body>

</html>