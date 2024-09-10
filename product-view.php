<?php
session_start();
require_once "MySQL.php";

if (empty($_GET["product"])) {
    header("Location: 404.php");
    exit();
}

$pid = $_GET['product'];
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="assets/images/favicon/6.png"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="msapplication-TileImage" content="assets/images/favicon/6.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <title>Greenway - Product View</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">

    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="assets/css/vendors/ion.rangeSlider.min.css"/>

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

<?php
$productRs = MySQL::search("SELECT *, product.id as pid FROM product JOIN brand b on product.brand_id = b.id JOIN category c on c.id = b.category_id JOIN unit u on product.unit_id = u.id JOIN status s on product.status_id = s.id WHERE product.id = '$pid'");

$brandId = 0;
if ($productRs->num_rows > 0) {
    $product = $productRs->fetch_assoc();

if ($product["status_id"] == 2) {
    ?>
    <script>
        window.location = "404.php";
    </script>
<?php
exit();
}

$brandId = $product['brand_id'];
?>

    <!-- Shop Section start -->
    <section id="home">
        <div class="container">
            <div class="row gx-4 gy-5">
                <div class="col-12">
                    <div class="details-items">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="degree-section">
                                    <!-- main image start -->
                                    <div class="details-image ratio_asos">
                                        <div>
                                            <div>
                                                <?php
                                                $productImagesRs = MySQL::search("SELECT * FROM product_images WHERE product_id = '$pid'");
                                                $productImage = $productImagesRs->fetch_assoc();
                                                ?>
                                                <img src="<?= $productImage['code'] ?>" class="img-fluid w-100" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- main image end -->

                                    <!-- secondary images start -->
                                    <div class="d-flex justify-content-center gap-2">
                                        <?php
                                        mysqli_data_seek($productImagesRs, 0);
                                        while ($productImage = $productImagesRs->fetch_assoc()) {
                                            ?>
                                            <div>
                                                <img src="<?= $productImage['code'] ?>" style="height:150px" alt="">
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!-- secondary images end -->
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="cloth-details-size">
                                    <!--TODO: update product count-->
                                    <!-- product count start -->
                                    <div class="product-count">
                                        <ul>
                                            <li>
                                                <img src="assets/images/gif/fire.gif" class="img-fluid blur-up lazyload"
                                                     alt="image">
                                                <span class="p-counter">37</span>
                                                <span class="lang">orders in last 24 hours</span>
                                            </li>
                                            <li>
                                                <img src="assets/images/gif/person.gif" class="img-fluid user_img"
                                                     alt="image">
                                                <span class="p-counter">44</span>
                                                <span class="lang">active view this</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- product count start -->

                                    <!-- product title start -->
                                    <div class="details-image-concept">
                                        <h2><?= $product['title'] ?></h2>
                                    </div>
                                    <!-- product title end -->

                                    <!-- product category start -->
                                    <div class="label-section">
                                        <span class="badge badge-grey-color"><?= $product['brand'] ?></span>
                                        <span class="label-text">in <?= $product['category'] ?></span>
                                    </div>
                                    <!-- product category end -->

                                    <!-- product price start -->
                                    <h3 class="price-detail">
                                        Rs. <?= $product['price'] ?>
                                        <del>Rs. <?= (($product['price'] * 25) / 100) + $product['price'] ?></del>
                                        <span><?= ($product['qty'] > 0) ? $product['qty'] . " Quantities Left" : "OUT OF STOCK" ?></span>
                                    </h3>
                                    <!-- product price end -->

                                    <?php
                                    if ($product['qty'] > 0) {
                                        ?>
                                        <!-- product size start -->
                                        <div id="selectSize"
                                             class="addeffect-section product-description border-product">
                                            <h6 class="product-title product-title-2 d-block">quantity</h6>

                                            <div class="qty-box">
                                                <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn"
                                                            onclick="decrementProductQty('<?= $product['pid'] ?>')">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </span>
                                                    <input type="text" name="quantity" class="form-control input-number"
                                                           id="prodQty" value="1"
                                                           onkeyup="changeProductQty('<?= $product['pid'] ?>')">
                                                    <span class="input-group-prepend">
                                                    <button type="button" class="btn"
                                                            onclick="incrementProductQty('<?= $product['pid'] ?>')">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product size end -->

                                        <!-- wishlist & add to cart start -->
                                        <div class="product-buttons">
                                            <a href="javascript:void(0)" class="btn btn-solid addToWishlist"
                                               id="<?= $product['pid'] ?>">
                                                <i class="fa fa-bookmark fz-16 me-2"></i>
                                                <span>Wishlist</span>
                                            </a>
                                            <a href="javascript:addToCart('<?= $product['pid'] ?>')" id="cartEffect"
                                               class="btn btn-solid hover-solid btn-animation">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>Add To Cart</span>
                                            </a>
                                        </div>
                                        <!-- wishlist & add to cart start -->
                                        <?php
                                    } else {
                                        ?>
                                        <!-- product size start -->
                                        <div id="selectSize"
                                             class="addeffect-section product-description border-product">
                                            <h6 class="product-title product-title-2 d-block">quantity</h6>

                                            <div class="qty-box">
                                                <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </span>
                                                    <input type="text" name="quantity" class="form-control input-number"
                                                           id="prodQty" value="0">
                                                    <span class="input-group-prepend">
                                                    <button type="button" class="btn">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product size end -->

                                        <!-- wishlist & add to cart start -->
                                        <div class="product-buttons">
                                            <a href="javascript:void(0)" class="btn btn-solid">
                                                <i class="fa fa-exclamation fz-16 me-2"></i>
                                                <span>OUT OF STOCK</span>
                                            </a>
                                        </div>
                                        <!-- wishlist & add to cart start -->
                                        <?php
                                    }
                                    ?>

                                    <!-- shipping start -->
                                    <ul class="product-count shipping-order">
                                        <li>
                                            <img src="assets/images/gif/truck.png" class="img-fluid blur-up lazyload"
                                                 alt="image">
                                            <span class="lang">Shipping Fee - Rs.500/=</span>
                                        </li>
                                    </ul>
                                    <!-- shipping end -->

                                    <!-- share product start -->
                                    <div class="border-product">
                                        <h6 class="product-title d-block">share it</h6>
                                        <div class="product-icon">
                                            <ul class="product-social">
                                                <li>
                                                    <a href="https://www.facebook.com/">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.google.com/">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.instagram.com/">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <li class="pe-0">
                                                    <a href="https://www.google.com/">
                                                        <i class="fas fa-rss"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- share product start -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- description & QA & review section start -->
                <div class="col-12">
                    <div class="cloth-review">

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#desc" type="button">Description
                                </button>

                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button">Review
                                </button>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <!-- description start -->
                            <div class="tab-pane fade show active" id="desc">
                                <h2 class="mb-4">Product Description</h2>

                                <div class="shipping-chart">
                                    <div class="part">
                                        <h4 class="inner-title mb-2"><?= $product['title'] ?></h4>
                                        <p class="font-light"><?= $product['description'] ?></p>
                                    </div>

                                </div>
                            </div>
                            <!-- description end -->


                            <!-- reviews starts -->
                            <div class="tab-pane fade" id="review">
                                <div class="row g-4">
                                    <div class="col-lg-4">
                                        <div class="customer-rating">
                                            <h2>Customer reviews</h2>
                                            <ul class="rating my-2 d-inline-block">
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

                                            <div class="global-rating">
                                                <h5 class="font-light">82 Ratings</h5>
                                            </div>

                                            <ul class="rating-progess">
                                                <li>
                                                    <h5 class="me-3">5 Star</h5>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 78%"
                                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <h5 class="ms-3">78%</h5>
                                                </li>
                                                <li>
                                                    <h5 class="me-3">4 Star</h5>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 62%"
                                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <h5 class="ms-3">62%</h5>
                                                </li>
                                                <li>
                                                    <h5 class="me-3">3 Star</h5>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 44%"
                                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <h5 class="ms-3">44%</h5>
                                                </li>
                                                <li>
                                                    <h5 class="me-3">2 Star</h5>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 30%"
                                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <h5 class="ms-3">30%</h5>
                                                </li>
                                                <li>
                                                    <h5 class="me-3">1 Star</h5>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 18%"
                                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <h5 class="ms-3">18%</h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <!-- rating start -->
                                        <p class="d-inline-block me-2">Rating</p>
                                        <ul class="rating mb-3 d-inline-block">
                                            <li>
                                                <i class="fas fa-star rating-star" onclick="setRating(1)"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star rating-star" onclick="setRating(2)"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star rating-star" onclick="setRating(3)"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star rating-star" onclick="setRating(4)"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star rating-star" onclick="setRating(5)"></i>
                                            </li>
                                        </ul>
                                        <!-- rating end -->

                                        <!-- review form start -->
                                        <div class="review-box">
                                            <div class="row g-4">
                                                <div class="col-12 col-md-6">
                                                    <label class="mb-1" for="name">Name</label>
                                                    <input type="text" class="form-control" id="name"
                                                           placeholder="Enter your name" required>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <label class="mb-1" for="email">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                           placeholder="Enter your email" required>
                                                </div>

                                                <div class="col-12">
                                                    <label class="mb-1" for="comment">Comments</label>
                                                    <textarea class="form-control" placeholder="Leave a comment here"
                                                              id="comment" style="height: 100px" required></textarea>
                                                    <span id="rating-err" class="text-danger mt-2"></span>
                                                </div>

                                                <div class="col-12">
                                                    <button type="submit"
                                                            onclick="addNewReview('<?= $product['pid'] ?>');"
                                                            class="btn default-light-theme default-theme default-theme-2">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- review form end -->
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="customer-review-box">
                                            <h4>Customer Reviews</h4>


                                            <?php
                                            $reviewsRs = MySQL::search("SELECT * FROM reviews JOIN user u on reviews.user_email = u.email WHERE product_id = '$pid'");
                                            while ($review = $reviewsRs->fetch_assoc()) {
                                                ?>
                                                <!-- single review start -->
                                                <div class="customer-section">
                                                    <div class="customer-profile">
                                                        <svg style="enable-background:new 0 0 24 24;" version="1.1"
                                                             viewBox="0 0 24 24" xml:space="preserve"
                                                             xmlns="http://www.w3.org/2000/svg"><g id="info"/>
                                                            <g id="icons">
                                                                <path d="M12,0C5.4,0,0,5.4,0,12c0,6.6,5.4,12,12,12s12-5.4,12-12C24,5.4,18.6,0,12,0z M12,4c2.2,0,4,2.2,4,5s-1.8,5-4,5   s-4-2.2-4-5S9.8,4,12,4z M18.6,19.5C16.9,21,14.5,22,12,22s-4.9-1-6.6-2.5c-0.4-0.4-0.5-1-0.1-1.4c1.1-1.3,2.6-2.2,4.2-2.7   c0.8,0.4,1.6,0.6,2.5,0.6s1.7-0.2,2.5-0.6c1.7,0.5,3.1,1.4,4.2,2.7C19.1,18.5,19.1,19.1,18.6,19.5z"
                                                                      id="user2"/>
                                                            </g></svg>
                                                    </div>

                                                    <div class="customer-details">
                                                        <h5><?= $review['fname'] . ' ' . $review['lname'] ?></h5>

                                                        <ul class="rating my-2 d-inline-block">
                                                            <?php
                                                            for ($x = 1; $x <= 5; $x++) {
                                                                if ($x <= $review['rating']) {
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
                                                            ?>
                                                        </ul>

                                                        <p class="font-light"><?= $review['review'] ?></p>

                                                        <p class="date-custo font-light">
                                                            - <?= date_format(date_create($review['date_added']), "M d, Y") ?></p>
                                                    </div>
                                                </div>
                                                <!-- single review start -->
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- reviews starts -->
                        </div>
                    </div>
                </div>
                <!-- description & QA & review section end -->

            </div>
        </div>
    </section>
    <!-- Shop Section end -->

    <?php
}
?>

<!-- product section start -->
<section class="ratio_asos section-b-space overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-lg-4 mb-3">Customers Also Bought These</h2>
                <div class="product-wrapper product-style-2 slide-4 p-0 light-arrow bottom-space">
                    <?php

                    $smProductRs = MySQL::search("SELECT *, product.id as pid FROM product JOIN brand b on b.id = product.brand_id WHERE b.id = '${brandId}' AND product.id <> '${product['pid']}'");
                    echo $smProductRs->num_rows;

                    while ($smproduct = $smProductRs->fetch_assoc()) {
                        ?>

                        <div>
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="front">
                                        <?php
                                        $imageRs = MySQL::search("SELECT * FROM product_images WHERE product_id='${smproduct['pid']}'");
                                        $image = $imageRs->fetch_assoc();
                                        ?>
                                        <a href="product-view.php?product=<?= $smproduct['pid'] ?>">
                                            <img src="<?= $image['code'] ?>"
                                                 class="bg-img blur-up lazyload" alt="">
                                        </a>
                                    </div>

                                    <?php
                                    if ($smproduct['qty'] > 0) {
                                        ?>
                                        <div class="cart-wrap">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)" class="addtocart-btn addToCart"
                                                       id="<?= $smproduct['pid'] ?>">
                                                        <i class="fa fa-shopping-bag"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)"
                                                       class="wishlist addToWishlist" id="<?= $smproduct['pid'] ?>">
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
                                                    <a href="javascript:void(0)" class="addtocart-btn">
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
                                    <h3 class="theme-color">Rs.<?= $smproduct['price'] ?><span
                                                class="font-light">Rs.<?= (($smproduct['price'] * 25) / 100) + $smproduct['price']; ?></span>
                                    </h3>
                                    <a href="product-view.php?product=<?= $smproduct['pid'] ?>" class="font-default">
                                        <h5><?= $smproduct['title'] ?></h5>
                                    </a>
                                    <ul class="size-box">
                                        <li><?= $smproduct['brand'] ?></li>
                                    </ul>
                                    <ul class="rating mt-1">
                                        <?php

                                        $ratingRs = MySQL::search("SELECT rating FROM reviews WHERE product_id = '${smproduct['pid']}' GROUP BY rating ORDER BY COUNT(*) DESC LIMIT 1");

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
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->

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
<?php require "footer.php" ?>
<!-- footer end -->

<!-- Quick view modal start -->
<div class="modal fade quick-view-modal" id="quick-view">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="quick-view-image">
                            <div class="quick-view-slider">
                                <div>
                                    <img src="assets/images/fashion/product/front/4.jpg"
                                         class="img-fluid blur-up lazyload" alt="product">
                                </div>
                                <div>
                                    <img src="assets/images/fashion/product/front/5.jpg"
                                         class="img-fluid blur-up lazyload" alt="product">
                                </div>
                                <div>
                                    <img src="assets/images/fashion/product/front/6.jpg"
                                         class="img-fluid blur-up lazyload" alt="product">
                                </div>
                                <div>
                                    <img src="assets/images/fashion/product/front/7.jpg"
                                         class="img-fluid blur-up lazyload" alt="product">
                                </div>
                            </div>
                            <div class="quick-nav">
                                <div>
                                    <img src="assets/images/fashion/product/front/4.jpg"
                                         class="img-fluid blur-up lazyload" alt="product">
                                </div>
                                <div>
                                    <img src="assets/images/fashion/product/front/5.jpg"
                                         class="img-fluid blur-up lazyload" alt="product">
                                </div>
                                <div>
                                    <img src="assets/images/fashion/product/front/6.jpg"
                                         class="img-fluid blur-up lazyload" alt="product">
                                </div>
                                <div>
                                    <img src="assets/images/fashion/product/front/7.jpg"
                                         class="img-fluid blur-up lazyload" alt="product">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-right">
                            <h2 class="mb-2">Men's Hoodie t-shirt</h2>
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
                                <li class="font-light">(In stock)</li>
                            </ul>
                            <div class="price mt-3">
                                <h3>$20.00</h3>
                            </div>
                            <div class="color-types">
                                <h4>colors</h4>
                                <ul class="color-variant mb-0">
                                    <li class="bg-half-light selected"></li>
                                    <li class="bg-light1"></li>
                                    <li class="bg-blue1"></li>
                                    <li class="bg-black1"></li>
                                </ul>
                            </div>
                            <div class="size-detail">
                                <h4>size</h4>
                                <ul class="">
                                    <li class="selected">S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                            </div>
                            <div class="product-details">
                                <h4>product details</h4>
                                <ul>
                                    <li>
                                        <span class="font-light">Style :</span> Hoodie
                                    </li>
                                    <li>
                                        <span class="font-light">Catgory :</span> T-shirt
                                    </li>
                                    <li>
                                        <span class="font-light">Tags:</span> summer, organic
                                    </li>
                                </ul>
                            </div>
                            <div class="product-btns">
                                <button type="button" class="btn btn-solid-default btn-sm"
                                        data-bs-dismiss="modal">Add to cart
                                </button>
                                <button type="button" class="btn btn-solid-default btn-sm"
                                        data-bs-dismiss="modal">View details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick view modal end -->

<!-- Cart Successful Start -->
<div class="modal fade cart-modal" id="addtocart" tabindex="-1" role="dialog" aria-label="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="modal-contain">
                    <div>
                        <div class="modal-messages">
                            <i class="fas fa-check"></i> 3-stripes full-zip hoodie successfully added to
                            you cart.
                        </div>
                        <div class="modal-product">
                            <div class="modal-contain-img">
                                <img src="assets/images/fashion/instagram/4.jpg" class="img-fluid blur-up lazyload"
                                     alt="">
                            </div>
                            <div class="modal-contain-details">
                                <h4>Premier Cropped Skinny Jean</h4>
                                <p class="font-light my-2">Yellow, Qty : 3</p>
                                <div class="product-total">
                                    <h5>TOTAL : <span>$1,140.00</span></h5>
                                </div>
                                <div class="shop-cart-button mt-3">
                                    <a href="shop.php"
                                       class="btn default-light-theme conti-button default-theme default-theme-2 rounded">CONTINUE
                                        SHOPPING</a>
                                    <a href="cart.php"
                                       class="btn default-light-theme conti-button default-theme default-theme-2 rounded">VIEW
                                        CART</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ratio_asos mt-4">
                    <div class="container">
                        <div class="row m-0">
                            <div class="col-sm-12 p-0">
                                <div
                                        class="product-wrapper product-style-2 slide-4 p-0 light-arrow bottom-space spacing-slider">
                                    <div>
                                        <div class="product-box">
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-left-sidebar.html">
                                                        <img src="assets/images/fashion/product/front/1.jpg"
                                                             class="bg-img blur-up lazyload" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-details text-center">
                                                <div class="rating-details d-block text-center">
                                                    <span class="font-light grid-content">B&Y Jacket</span>
                                                </div>
                                                <div class="main-price mt-0 d-block text-center">
                                                    <h3 class="theme-color">$78.00</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="product-box">
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-left-sidebar.html">
                                                        <img src="assets/images/fashion/product/front/2.jpg"
                                                             class="bg-img blur-up lazyload" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-details text-center">
                                                <div class="rating-details d-block text-center">
                                                    <span class="font-light grid-content">B&Y Jacket</span>
                                                </div>
                                                <div class="main-price mt-0 d-block text-center">
                                                    <h3 class="theme-color">$78.00</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="product-box">
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-left-sidebar.html">
                                                        <img src="assets/images/fashion/product/front/3.jpg"
                                                             class="bg-img blur-up lazyload" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-details text-center">
                                                <div class="rating-details d-block text-center">
                                                    <span class="font-light grid-content">B&Y Jacket</span>
                                                </div>
                                                <div class="main-price mt-0 d-block text-center">
                                                    <h3 class="theme-color">$78.00</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="product-box">
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-left-sidebar.html">
                                                        <img src="assets/images/fashion/product/front/4.jpg"
                                                             class="bg-img blur-up lazyload" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-details text-center">
                                                <div class="rating-details d-block text-center">
                                                    <span class="font-light grid-content">B&Y Jacket</span>
                                                </div>
                                                <div class="main-price mt-0 d-block text-center">
                                                    <h3 class="theme-color">$78.00</h3>
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
    </div>
</div>
<!-- Cart Successful End -->

<!-- toast start -->
<div class="toast-container position-fixed end-0 bottom-0 p-3">
    <div id="mytoast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">GreenWay</strong>
            <img src="assets/images/favicon/6.png" style="height: 20px" class="rounded me-2" alt="...">
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</div>
<!-- toast end -->

<!-- Add To Cart Notification -->
<div class="added-notification">
    <img src="assets/images/fashion/banner/2.jpg" class="img-fluid blur-up lazyload" alt="">
    <h3>added to cart</h3>
</div>
<!-- Add To Cart Notification -->

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

<!-- timer js -->
<script src="assets/js/timer.js"></script>

<!-- sticky cart bottom js-->
<script src="assets/js/sticky-cart-bottom.js"></script>

<!-- sticky cart bottom js-->
<script src="assets/js/check-box-select.js"></script>

<!-- Zoom Js -->
<script src="assets/js/jquery.elevatezoom.js"></script>
<script src="assets/js/zoom-filter.js"></script>

<!--Plugin JavaScript file-->
<script src="assets/js/ion.rangeSlider.min.js"></script>

<!-- Filter Hide and show Js -->
<script src="assets/js/filter.js"></script>

<!-- add to cart modal resize -->
<script src="assets/js/cart_modal_resize.js"></script>

<!-- Notify js-->
<script src="assets/js/bootstrap/bootstrap-notify.min.js"></script>

<!-- script js -->
<script src="assets/js/script.js"></script>
<script src="assets/js/customer.js"></script>

</body>

</html>