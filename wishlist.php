<?php
require_once "MySQL.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: unauthorized.php");
    exit();
}

$userEmail = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="assets/images/favicon/6.png"/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <title>GreenWay - Wishlist</title>

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
<?php require "header.php" ?>
<!-- header end -->

<!-- mobile fix menu start -->
<?php require "mobile-fix-menu.php" ?>
<!-- mobile fix menu end -->


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
                <h3>Wishlist</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb section end -->

<!-- Cart Section Start -->
<section class="wish-list-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table class="table cart-table wishlist-table">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">image</th>
                        <th scope="col">product name</th>
                        <th scope="col">price</th>
                        <th scope="col">availability</th>
                        <th scope="col">action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $wishlistRs = MySQL::search("SELECT *,wishlist.id as wid FROM wishlist JOIN product p on p.id = wishlist.product_id WHERE user_email='$userEmail'");
                    if ($wishlistRs->num_rows > 0) {
                        while ($wishItem = $wishlistRs->fetch_assoc()) {
                            if ($wishItem["status_id"] == 2) {
                                continue;
                            }
                            ?>
                            <tr>
                                <td>
                                    <a href="product-view.php?product=<?= $wishItem['product_id'] ?>">
                                        <?php

                                        $pImageRs = MySQL::search("SELECT * FROM product_images WHERE product_id = '${wishItem["product_id"]}'");
                                        $image = $pImageRs->fetch_assoc();
                                        ?>
                                        <img src="<?= $image['code'] ?>" class="blur-up lazyload"
                                             alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="product-view.php?product=<?= $wishItem['product_id'] ?>"
                                       class="font-light"><?= $wishItem['title'] ?></a>
                                    <div class="mobile-cart-content row">
                                        <div class="col">
                                            <p><?= ($wishItem > 0) ? "In Stock" : "Out of Stock" ?></p>
                                        </div>
                                        <div class="col">
                                            <p class="fw-bold">Rs.<?= $wishItem['price'] ?></p>
                                        </div>
                                        <div class="col">
                                            <h2 class="td-color">
                                                <a href="javascript:removeFromWishlist('<?= $wishItem['wid'] ?>');"
                                                   class="icon">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </h2>
                                            <h2 class="td-color">
                                                <a href="product-view.php?product=<?= $wishItem['product_id'] ?>"
                                                   class="icon">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-bold">Rs.<?= $wishItem['price'] ?></p>
                                </td>
                                <td>
                                    <p><?= ($wishItem > 0) ? "In Stock" : "Out of Stock" ?></p>
                                </td>
                                <td>
                                    <a href="javascript:removeFromWishlist('<?= $wishItem['wid'] ?>');" class="icon">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <a href="product-view.php?product=<?= $wishItem['product_id'] ?>" class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">Your Wishlist Empty</td>
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
<!-- Cart Section End -->

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

<!-- toast start -->
<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1;">
    <div id="mytoast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="assets/images/favicon/6.png" style="height: 20px" class="rounded me-2" alt="...">
            <strong class="me-auto">GreenWay</strong>
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</div>
<!-- toast end -->

<div class="bg-overlay"></div>

<!-- latest jquery-->
<script src="assets/js/jquery-3.5.1.min.js"></script>

<!-- Add To Home js -->
<script src="assets/js/pwa.js"></script>

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
<script src="assets/js/customer.js"></script>
</body>

</html>