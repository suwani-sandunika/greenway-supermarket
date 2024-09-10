<?php
session_start();
require_once "./MySQL.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/images/favicon/6.png">
    <meta name="theme-color" content="#51983c">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <title>GreenWay - Home</title>

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

<!-- home slider start -->
<section class="pt-0 poster-section-6" id="home">
    <div class="poster-image slider-for custome-arrow classic-arrow-1">
        <div>
            <img src="assets/images/vegetable/poster/1.png" class="img-fluid blur-up lazyload" alt="">
        </div>

        <div>
            <img src="assets/images/vegetable/poster/2.png" class="img-fluid blur-up lazyload" alt="">
        </div>

        <div>
            <img src="assets/images/vegetable/poster/3.png" class="img-fluid blur-up lazyload" alt="">
        </div>
    </div>

    <div class="background-circle">
        <img src="assets/images/vegetable/poster/circle.png" class="img-fluid blur-up lazyload" alt="">
    </div>

    <div class="slider-nav image-show">
        <div>
            <div class="poster-img">
                <img src="assets/images/vegetable/poster/t1.jpg" class="img-fluid blur-up lazyload" alt="">
                <div class="overlay-color">
                    <i class="fas fa-plus theme-color"></i>
                </div>
            </div>
        </div>

        <div>
            <div class="poster-img">
                <img src="assets/images/vegetable/poster/t2.jpg" class="img-fluid blur-up lazyload" alt="">
                <div class="overlay-color">
                    <i class="fas fa-plus theme-color"></i>
                </div>
            </div>
        </div>

        <div>
            <div class="poster-img">
                <img src="assets/images/vegetable/poster/t3.jpg" class="img-fluid blur-up lazyload" alt="">
                <div class="overlay-color">
                    <i class="fas fa-plus theme-color"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-contain">
        <div class="banner-left">
            <h4>Sale <span class="theme-color">35% Off</span></h4>
            <h1>Fresh & Tasty <span>Corn Cobe</span></h1>
            <p>BUY ONE GET ONE <span class="theme-color">FREE</span></p>
            <h2>$79.00 <span class="theme-color"><del>$65.00</del></span></h2>
            <p class="poster-details">Lorem Ipsum is simply dummy text of typesetting.</p>
            <div class="banner-btn-grup">
                <button onclick="abc()" type="button"
                        class="btn btn-solid-default">Shop Now
                </button>
            </div>
        </div>
    </div>
</section>
<!-- home slider end -->

<!-- Custome services Section Start -->
<section class="service-section">
    <div class="container">
        <div class="row g-4 g-sm-3">
            <div class="col-xl-3 col-sm-6">
                <div class="service-wrap">
                    <div class="service-icon">
                        <svg>
                            <use xlink:href="assets/svg/icons.svg#customer"></use>
                        </svg>
                    </div>
                    <div class="service-content">
                        <h3 class="mb-2">Customer Servcies</h3>
                        <span class="font-light">Top notch customer service.</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="service-wrap">
                    <div class="service-icon">
                        <svg>
                            <use xlink:href="assets/svg/icons.svg#shop"></use>
                        </svg>
                    </div>
                    <div class="service-content">
                        <h3 class="mb-2">Pickup At Any Store</h3>
                        <span class="font-light">Free shipping on orders over $65.</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="service-wrap">
                    <div class="service-icon">
                        <svg>
                            <use xlink:href="assets/svg/icons.svg#secure-payment"></use>
                        </svg>
                    </div>
                    <div class="service-content">
                        <h3 class="mb-2">Secured Payment</h3>
                        <span class="font-light">We accept all major credit cards.</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="service-wrap">
                    <div class="service-icon">
                        <svg>
                            <use xlink:href="assets/svg/icons.svg#return"></use>
                        </svg>
                    </div>
                    <div class="service-content">
                        <h3 class="mb-2">Free Returns</h3>
                        <span class="font-light">30-days free return policy.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Custome services Section End -->

<!-- banner section start -->
<section class="ratio_landscape banner-style-2">
    <div class="container">
        <div class="row gy-3">
            <div class="col-xl-5 col-lg-4 col-md-6 custom-col">
                <div class="collection-banner text-center">
                    <div class="banner-img">
                        <img src="assets/images/vegetable/banner/1.jpg" class="bg-img blur-up lazyload" alt="">
                    </div>
                    <div class="banner-detail">
                        <a href="javacript:void(0)" class="heart-wishlist">
                            <i class="far fa-heart"></i>
                        </a>
                        <span class="font-dark-30">26% <span>OFF</span></span>
                    </div>
                    <a href="" class="contain-banner contain-center bottom-0">
                        <div class="banner-content with-bg">
                            <h2 class="mb-2">Lemons</h2>
                            <span>BUY ONE GET ONE FREE</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 order-lg-0 order-md-1 order-0">
                <div class="collection-banner text-center collection-center p-0">
                    <div class="banner-img">
                        <img src="assets/images/vegetable/percentage.jpg" class="bg-img blur-up lazyload" alt="">
                    </div>
                    <div class="contain-banner contain-center bottom-0">
                        <div class="banner-content p-2">
                            <h6 class="theme-color mb-2">Get Rewarded</h6>
                            <h2>Earn 10% </h2>
                            <h2>Back Reward</h2>
                            <p class="mt-2">Valid online & in-store with select styles.</p>
                            <button onclick="location.href = '';"
                                    class="btn btn-solid-default">Learn more
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-4 col-md-6 custom-col">
                <div class="collection-banner text-center">
                    <div class="banner-img">
                        <img src="assets/images/vegetable/banner/2.jpg" class="bg-img blur-up lazyload" alt="">
                    </div>
                    <div class="banner-detail">
                        <a href="javacript:void(0)" class="heart-wishlist">
                            <i class="far fa-heart"></i>
                        </a>
                        <span class="font-dark-30">26% <span>OFF</span></span>
                    </div>
                    <a href="" class="contain-banner contain-center bottom-0">
                        <div class="banner-content with-bg">
                            <h2 class="mb-2">kiwi </h2>
                            <span>BUY ONE GET ONE FREE</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->

<!-- New Arrival Section Start -->
<section class="ratio_asos">
    <div class="container-fluid p-sm-0">
        <div class="row m-0">
            <div class="col-sm-12 p-0">
                <!-- load categories -->
                <?php
                $catRs = MySQL::search("SELECT * FROM category");
                while ($cat = $catRs->fetch_assoc()) {
                    ?>
                    <div class="title text-center mt-5">
                        <h5>Just For You</h5>
                        <h2><?= $cat['category'] ?></h2>
                    </div>
                    <div class="product-wrapper slide-6">

                        <?php

                        $productRs = MySQL::search("SELECT *, product.id as pid FROM product JOIN brand b on b.id = product.brand_id JOIN category c on c.id = b.category_id WHERE c.id = '${cat['id']}' AND status_id = '1' LIMIT 8");
                        while ($product = $productRs->fetch_assoc()) {
                            ?>
                            <!-- product start -->
                            <div>
                                <div class="product-box">
                                    <div class="img-wrapper hover-image">
                                        <?php
                                        $imageRs = MySQL::search("SELECT * FROM product_images WHERE product_id='${product['pid']}'");
                                        $image = $imageRs->fetch_assoc();
                                        ?>
                                        <a href="product-view.php?product=<?= $product['pid']; ?>">
                                            <img src="<?= $image['code'] ?>"
                                                 class="img-fluid bg-img blur-up lazyload" alt="">
                                        </a>
                                        <?php
                                        if ($product['qty'] > 0) {
                                            ?>
                                            <div class="cart-wrap">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0)" class="addtocart-btn addToCart"
                                                           id="<?= $product['pid'] ?>">
                                                            <i class="fa fa-shopping-bag"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                           class="wishlist addToWishlist" id="<?= $product['pid'] ?>">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="cart-wrap">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0)" class="addtocart-btn"
                                                           id="<?= $product['pid'] ?>">
                                                            OUT OF STOCK
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                            <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="product-details text-center">
                                        <h3 class="theme-color">Rs.<?= $product['price'] ?><span class="font-light">Rs.<?= (($product['price'] * 25) / 100) + $product['price']; ?></span>
                                        </h3>
                                        <a href="product-view.php?product=<?= $product['pid'] ?>" class="font-default">
                                            <h5><?= $product['title'] ?></h5>
                                        </a>
                                        <ul class="size-box">
                                            <li><?= $product['brand'] ?></li>
                                        </ul>
                                        <ul class="rating mt-1">
                                            <?php

                                            $ratingRs = MySQL::search("SELECT rating FROM reviews WHERE product_id = '${product['pid']}' GROUP BY rating ORDER BY COUNT(*) DESC LIMIT 1");

                                            if ($ratingRs->num_rows > 0) {
                                                $rating = $ratingRs->fetch_assoc();

                                                for ($x = 1; $x <= 5; $x++) {
                                                    if ($x <= $rating['rating']) {
                                                        ?>
                                                        <li>
                                                            <i class="fas fa-star theme-color"></i>
                                                        </li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li>
                                                            <i class="fas fa-star"></i>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- product end -->
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- New Arrival Section End -->


<!-- Banner section 2 start -->
<section class="ratio2_1 section-b-space">
    <div class="container">
        <div class="row gy-3">
            <div class="col-xl-9 col-lg-8">
                <div class="timer-banner text-center">
                    <img src="assets/images/vegetable/percentage.jpg" class="bg-img blur-up lazyload" alt="">
                    <img src="assets/images/vegetable/1234.png" class="img-fluid veg-image" alt="">
                    <img src="assets/images/vegetable/circle.png" class="round-circle" alt="">
                    <div class="coupon-code theme-color">
                        DGR548548
                    </div>
                    <div class="discount-offer">
                        <h5>New Festival Offer
                            <span class="theme-color">70% OFF
                                    <span class="wishlist-icon mt-2">
                                        <i class="fas fa-heart"></i>
                                    </span>
                                </span>
                        </h5>
                    </div>

                    <div class="timer">
                        <ul class="light-color">
                            <li>
                                <div class="counter">
                                    <div>
                                        <h2 id="days1"></h2>Days
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="counter">
                                    <div>
                                        <h2 id="hours1"></h2>Hour
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="counter">
                                    <div>
                                        <h2 id="minutes1"></h2>Min
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="counter">
                                    <div>
                                        <h2 id="seconds1"></h2>Sec
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="banner-btn-grup">
                        <button onclick="location.href = '';" type="button"
                                class="btn btn-solid-default">Shop Now
                        </button>
                    </div>

                    <div class="social-media">
                        <div class="social-icon">
                            <img src="assets/images/social-icon/1.png" class="img-fluid blur-up lazyload" alt="">
                            <h6>Facebook</h6>
                        </div>

                        <div class="social-icon">
                            <img src="assets/images/social-icon/2.png" class="img-fluid blur-up lazyload" alt="">
                            <h6>Instagram</h6>
                        </div>

                        <div class="social-icon">
                            <img src="assets/images/social-icon/3.png" class="img-fluid blur-up lazyload" alt="">
                            <h6>Twitter</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 small-banner">
                <div class="collection-banner text-center collection-center">
                    <img src="assets/images/vegetable/offer/2.jpg" class="bg-img blur-up lazyload" alt="">
                    <div>
                        <h6 class="theme-color mb-2">New Headphone</h6>
                        <h2>50% Cash </h2>
                        <h2>Back Reward</h2>
                        <p class="mt-2 mb-0 font-light">Limited offer </p>
                        <p class="font-light mb-0"> Buy now!!</p>
                        <button onclick="location.href = '';" type="button"
                                class="btn btn-solid-default mt-4">Shop now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner section 2 end -->

<!-- Promo Code Section Start -->
<section class="code-section pt-0">
    <div class="overlay-color">
        <div class="container">
            <div class="row px-0">
                <div class="col-lg-8 col-md-8">
                    <div class="code-contain">
                        <div class="code-image">
                            <img src="assets/images/vegetable/percent.png" class="img-fluid blur-up lazyload"
                                 alt="">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <h6>30% Offer Today First 50 Customer : USE PROMO CODE <span>VEG45652</span></h6>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 d-flex">
                    <div class="text-md-end text-center mt-md-0 mt-3 w-100">
                        <button type="button" class="btn btn-size default-white">OPEN PRODICT PAGE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Promo Code Section End -->

<!-- New Arrival Section Start -->
<section class="ratio_asos category-style-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="title text-center">
                    <h5>Just For You</h5>
                    <h2>Fresh Fruits</h2>
                </div>
            </div>

            <div class="product-wrapper slide-4">
                <div>
                    <div class="category-image-fruit">
                        <img src="assets/images/vegetable/category/1.jpg" class="img-fluid blur-up lazyload" alt="">
                        <div class="category-contain">
                            <img src="assets/images/vegetable/category/1.png" class="blur-up lazyload" alt="">
                        </div>

                        <div class="category-text">
                            <h2>Citrus</h2>
                            <h5>Healthy Fruits</h5>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="category-image-fruit">
                        <img src="assets/images/vegetable/category/2.jpg" class="img-fluid blur-up lazyload" alt="">
                        <div class="category-contain">
                            <img src="assets/images/vegetable/category/2.png" class=" blur-up lazyload" alt="">
                        </div>

                        <div class="category-text">
                            <h2>Stone Fruit</h2>
                            <h5>Healthy Fruits</h5>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="category-image-fruit">
                        <img src="assets/images/vegetable/category/3.jpg" class="img-fluid blur-up lazyload" alt="">
                        <div class="category-contain">
                            <img src="assets/images/vegetable/category/3.png" class=" blur-up lazyload" alt="">
                        </div>

                        <div class="category-text">
                            <h2>Tropical</h2>
                            <h5>Healthy Fruits</h5>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="category-image-fruit">
                        <img src="assets/images/vegetable/category/4.jpg" class="img-fluid blur-up lazyload" alt="">
                        <div class="category-contain">
                            <img src="assets/images/vegetable/category/4.png" class=" blur-up lazyload" alt="">
                        </div>

                        <div class="category-text">
                            <h2>Berries</h2>
                            <h5>Healthy Fruits</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- New Arrival Section End -->

<!-- tab banner section start -->
<section class="tab-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="title text-center">
                    <h5>Special Offer</h5>
                    <h2>Hurry up!</h2>
                </div>
                <div class="tab-wrap">

                    <div class="tab-content" id="myTabContent">
                        <div class="offer-wrap product-style-1">
                            <div class="row g-xl-4 g-3">
                                <div class="col-lg-4 col-md-6">
                                    <div class="product-list">
                                        <div class="product-box product-box-4">
                                            <div class="img-wrapper bg-trans">
                                                <a href="#" class="text-center">
                                                    <img src="assets/images/vegetable/offer-1/1.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <h3 class="theme-color">
                                                    $57.00
                                                    <span class="font-light">$54.00</span>
                                                </h3>
                                                <a href="#" class="font-default">
                                                    <h5>Fresh And Tasty Red cabbage Per Piece</h5>
                                                </a>
                                                <ul class="rating mt-1">
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-box product-box-4">
                                            <div class="img-wrapper bg-trans">
                                                <a href="#" class="text-center">
                                                    <img src="assets/images/vegetable/offer-1/2.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <h3 class="theme-color">
                                                    $42.00
                                                    <span class="font-light">$39.00</span>
                                                </h3>
                                                <a href="#" class="font-default">
                                                    <h5>Rad Testy Fresh Tomato</h5>
                                                </a>
                                                <ul class="rating mt-1">
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-box product-box-4">
                                            <div class="img-wrapper bg-trans">
                                                <a href="#" class="text-center">
                                                    <img src="assets/images/vegetable/offer-1/3.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <h3 class="theme-color">
                                                    $25.00
                                                    <span class="font-light">$20.00</span>
                                                </h3>
                                                <a href="#" class="font-default">
                                                    <h5>Standard Come</h5>
                                                </a>
                                                <ul class="rating mt-1">
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 product-banner">
                                    <div class="product-box bg-image">
                                        <div class="img-wrapper bg-trans">
                                            <div class="label-block">
                                                <span class="label label-black">New</span>
                                            </div>
                                            <a href="javascript:void(0)">
                                                <img src="assets/images/vegetable/offer-1/big.png"
                                                     class="img-fluid blur-up lazyload" alt="">
                                                <img src="assets/images/vegetable/circle.png" class="round-circle"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="product-details text-center">
                                            <h3 class="theme-color">
                                                $600.00
                                                <span class="font-light ml-1">$945.00</span>
                                            </h3>
                                            <a href="javascript:void(0)" class="font-default" tabindex="-1">
                                                <h5 class="mx-auto">Juicy Lemone</h5>
                                            </a>
                                            <ul class="rating mt-1">
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="product-list">
                                        <div class="product-box product-box-4">
                                            <div class="img-wrapper bg-trans">
                                                <a href="#" class="text-center">
                                                    <img src="assets/images/vegetable/offer-1/4.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <h3 class="theme-color">
                                                    $70.00
                                                    <span class="font-light">$68.00</span>
                                                </h3>
                                                <a href="#" class="font-default">
                                                    <h5>Fresh And Tasty Red cabbage Per Piece</h5>
                                                </a>
                                                <ul class="rating mt-1">
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-box product-box-4">
                                            <div class="img-wrapper bg-trans">
                                                <a href="#" class="text-center">
                                                    <img src="assets/images/vegetable/offer-1/5.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <h3 class="theme-color">$14.00<span class="font-light">$10.00</span>
                                                </h3>
                                                <a href="#" class="font-default">
                                                    <h5>Fresh And Tasty Red cabbage Per Piece</h5>
                                                </a>
                                                <ul class="rating mt-1">
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-box product-box-4">
                                            <div class="img-wrapper bg-trans">
                                                <a href="#" class="text-center">
                                                    <img src="assets/images/vegetable/offer-1/6.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <h3 class="theme-color">
                                                    $50.00
                                                    <span class="font-light">$45.00</span>
                                                </h3>
                                                <a href="#" class="font-default">
                                                    <h5>Fresh And Tasty Red cabbage Per Piece</h5>
                                                </a>
                                                <ul class="rating mt-1">
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- tab banner section end -->

<!-- Subscribe Section Start -->
<section class="subscribe-section-light section-b-space mt-5">
    <div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6">
                    <div class="subscribe-details">
                        <h2 class="mb-3 theme-color">Subscribe Our News</h2>
                        <h6>Subscribe and receive our newsletters to follow the news about our fresh and fantastic
                            Shoes Products.</h6>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
                    <div class="subsribe-input">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Your Email Address"
                                   aria-label="Recipient's username">
                            <button class="btn btn-solid-default" type="button">Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Subscribe Section End -->

<!-- brand section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brand-slider">
                    <div>
                        <div class="brand-image">
                            <img src="assets/images/brand/1.png" class="img-fluid blur-up lazyload"
                                 alt="brand logo">
                        </div>
                    </div>
                    <div>
                        <div class="brand-image">
                            <img src="assets/images/brand/2.png" class="img-fluid blur-up lazyload"
                                 alt="brand logo">
                        </div>
                    </div>
                    <div>
                        <div class="brand-image">
                            <img src="assets/images/brand/3.png" class="img-fluid blur-up lazyload"
                                 alt="brand logo">
                        </div>
                    </div>
                    <div>
                        <div class="brand-image">
                            <img src="assets/images/brand/4.png" class="img-fluid blur-up lazyload"
                                 alt="brand logo">
                        </div>
                    </div>
                    <div>
                        <div class="brand-image">
                            <img src="assets/images/brand/5.png" class="img-fluid blur-up lazyload"
                                 alt="brand logo">
                        </div>
                    </div>
                    <div>
                        <div class="brand-image">
                            <img src="assets/images/brand/6.png" class="img-fluid blur-up lazyload"
                                 alt="brand logo">
                        </div>
                    </div>
                    <div>
                        <div class="brand-image">
                            <img src="assets/images/brand/4.png" class="img-fluid blur-up lazyload"
                                 alt="brand logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- brand section end -->

<?php require "footer.php"; ?>


<!-- Newsletter modal start -->
<div class="modal fade newletter-modal" id="newsletter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <img src="assets/images/newletter-icon.png" class="img-fluid blur-up lazyload" alt="">
                <div class="modal-title">
                    <h2 class="tt-title">Sign up for our Newsletter!</h2>
                    <p class="font-light">Never miss any new updates or products we reveal, stay up to date.</p>
                    <p class="font-light">Oh, and it's free!</p>

                    <div class="input-group mb-3">
                        <input placeholder="Email" class="form-control" type="text">
                    </div>

                    <div class="cancel-button text-center">
                        <button class="btn default-theme w-100" data-bs-dismiss="modal"
                                type="button">Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter modal end -->

<!-- Coockie Section Start -->
<div class="cookie-bar-section veg-cookiebar">
    <div class="content">
        <img src="assets/images/cookie.png" alt="">
        <p class="font-light">This website use cookies to ensure you get the best experience on our website.</p>
        <div class="cookie-buttons">
            <button class="btn default-theme" id="button">I understand</button>
        </div>
    </div>
</div>
<!-- Coockie Section End -->

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