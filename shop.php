<?php
require "MySQL.php";
session_start();

if(!isset($_GET["search"])) {
    header("Location: 404.php");
    exit();
}

$search = $_GET["search"];
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
    <title>Shop</title>

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
                <h3>Shop Listing</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Shop Fashion</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb section end -->

<!-- Shop Section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="category-option">
                    <div class="button-close mb-3">
                        <button class="btn p-0"><i data-feather="arrow-left"></i> Close</button>
                    </div>
                    <div class="accordion category-name" id="accordionExample">

                        <!-- price start -->
                        <div class="accordion-item category-price">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour">Price
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse show"
                                 aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="range-slider category-list">
                                        <input type="text" class="js-range-slider" value="" id="priceSlider"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- price end -->

                        <!-- brand start -->
                        <div class="accordion-item category-rating">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo">
                                    Brand
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body category-scroll">
                                    <ul class="category-list">
                                        <?php
                                        $brandRs = MySQL::search("SELECT * FROM brand");
                                        while ($brand = $brandRs->fetch_assoc()) {
                                            ?>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it brandInput" type="checkbox"
                                                           id="brand<?= $brand['id'] ?>" value="<?= $brand['id'] ?>"
                                                           onchange="filterProducts(0, '<?= $_GET['search'] ?>')">
                                                    <label class="form-check-label"
                                                           for="brand<?= $brand['id'] ?>"><?= $brand['brand'] ?></label>
                                                    <p class="font-light">
                                                        (<?= MySQL::search("SELECT * FROM product WHERE brand_id='${brand['id']}'")->num_rows ?>
                                                        )</p>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- brand end -->

                        <!-- category start -->
                        <div class="accordion-item category-rating">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne">
                                    Category
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                 aria-labelledby="headingOne">
                                <div class="accordion-body category-scroll">
                                    <ul class="category-list">
                                        <?php
                                        $categoryRs = MySQL::search("SELECT * FROM category");
                                        while ($category = $categoryRs->fetch_assoc()) {
                                            ?>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it categoryInput"
                                                           type="checkbox"
                                                           id="category<?= $category['id'] ?>"
                                                           value="<?= $category['id'] ?>"
                                                           onchange="filterProducts(0, '<?= $_GET['search'] ?>')">
                                                    <label class="form-check-label"
                                                           for="category<?= $category['id'] ?>"><?= $category['category'] ?></label>
                                                    <p class="font-light">
                                                        (<?= MySQL::search("SELECT * FROM product JOIN brand b on product.brand_id = b.id JOIN category c on c.id = b.category_id WHERE c.id = '${category['id']}'")->num_rows ?>
                                                        )</p>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- category end -->

                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-12 ratio_30">
                <div class="row g-4">
                    <!-- filter button -->
                    <div class="filter-button">
                        <button class="btn filter-btn p-0"><i data-feather="align-left"></i> Filter</button>
                    </div>
                    <!-- filter button -->

                    <div class="col-12">
                        <div class="filter-options">
                            <div class="select-options">
                                <div class="page-view-filter">
                                    <div class="dropdown select-featured">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            24 Page per view
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">Alphabetically
                                                    A-Z</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">Alphabetically
                                                    Z-A</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">Price, High To
                                                    Low</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">Price, Low To
                                                    High</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">Date, Old To
                                                    New</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">Date, New To
                                                    Old</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-options d-sm-inline-block d-none">
                                <ul class="d-flex">
                                    <li class="two-grid">
                                        <a href="javascript:void(0)">
                                            <img src="assets/svg/grid-2.svg" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>
                                    </li>
                                    <li class="three-grid d-md-inline-block d-none">
                                        <a href="javascript:void(0)">
                                            <img src="assets/svg/grid-3.svg" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn active d-lg-inline-block d-none">
                                        <a href="javascript:void(0)">
                                            <img src="assets/svg/grid.svg" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="assets/svg/list.svg" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- label and featured section -->

                <div id="productsSection">
                    <!-- Prodcut setion -->
                    <div class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
                        <?php

                        $page = $_GET["page"] ?? 1;


                        $product_rs = MySQL::search("SELECT *, product.id AS `pid` , unit.`unit` AS `unit_name` FROM `product` INNER JOIN `status` ON product.status_id = `status`.id INNER JOIN unit ON product.unit_id = unit.id WHERE title LIKE '%" . $search . "%' AND product.status_id = '1'");

                        $no_of_products = $product_rs->num_rows;
                        $results_per_page = 12;
                        $no_of_pages = ceil($no_of_products / $results_per_page);
                        $viewed_result_count = ((int)$page - 1) * $results_per_page;

                        $product_rs2 = MySQL::search("SELECT *, product.id AS `pid` , unit.`unit` AS `unit_name` FROM `product` INNER JOIN `status` ON product.status_id = `status`.id INNER JOIN unit ON product.unit_id = unit.id JOIN brand b on product.brand_id = b.id WHERE title LIKE '%" . $search . "%' AND product.status_id = '1' LIMIT ${results_per_page} OFFSET ${viewed_result_count}");

                        while ($productData = $product_rs2->fetch_assoc()) {
                            ?>
                            <!-- product start -->
                            <div>
                                <div class="product-box">
                                    <div class="img-wrapper">
                                        <?php
                                        $imagesRs = MySQL::search("SELECT * FROM product_images WHERE product_id='${productData['pid']}'");
                                        $image = $imagesRs->fetch_assoc();
                                        ?>

                                        <!-- image front start -->
                                        <div class="front">
                                            <a href="product-view.php?product=<?= $productData['pid'] ?>">
                                                <img src="<?= $image['code'] ?>" style="height: 250px;"
                                                     class="bg-img blur-up lazyload" alt="">
                                            </a>
                                        </div>
                                        <!-- image front end -->

                                        <!-- image back start-->
                                        <div class="back">
                                            <a href="product-view.php?product=<?= $productData['pid'] ?>">
                                                <img src="<?= $image['code'] ?>" style="height: 250px"
                                                     class="bg-img blur-up lazyload" alt="">
                                            </a>
                                        </div>
                                        <!-- image back end-->

                                        <!-- buttons start -->
                                        <div class="cart-wrap">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)" class="addtocart-btn addToCart"
                                                       id="<?= $productData['pid'] ?>">
                                                        <i class="fa fa-shopping-bag"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)"
                                                       class="wishlist addToWishlist" id="<?= $productData['pid'] ?>">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- buttons end -->
                                    </div>

                                    <!-- product desc start -->
                                    <div class="product-details">
                                        <div class="rating-details">
                                            <span class="font-light grid-content"><?= $productData['brand'] ?></span>
                                            <ul class="rating mt-0">
                                                <?php

                                                $ratingRs = MySQL::search("SELECT rating FROM reviews WHERE product_id = '${productData['pid']}' GROUP BY rating ORDER BY COUNT(*) DESC LIMIT 1");

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
                                        <div class="main-price">
                                            <a href="product-view.php?product=<?= $productData['pid'] ?>"
                                               class="font-default">
                                                <h6 class="ms-0 fw-bold"><?= $productData['title'] ?></h6>
                                            </a>
                                            <div class="listing-content">
                                                <span class="font-light"><?= $productData['brand'] ?></span>
                                                <p class="font-light"><?= $productData['description'] ?></p>
                                            </div>
                                            <h3 class="theme-color">Rs.<?= $productData['price'] ?></h3>
                                            <button id="<?= $productData['pid'] ?>"
                                                    class="btn listing-content addToCart">
                                                Add
                                                To Cart
                                            </button>
                                        </div>
                                    </div>
                                    <!-- product desc end -->
                                </div>
                            </div>
                            <!-- product end -->
                            <?php
                        }
                        ?>


                    </div>
                    <!-- Prodcut setion -->

                    <nav class="page-section">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link"
                                   href="javascript:filterProducts(<?= ($page <= 1) ? $page : ($page - 1) ?>, '<?= $search ?>')"
                                   aria-label="Previous">
                                    <span aria-hidden="true">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </a>
                            </li>

                            <?php
                            for ($x = 1; $x <= $no_of_pages; $x++) {
                                if ($page == $x) {
                                    ?>
                                    <li class="page-item active">
                                        <a class="page-link"
                                           href="javascript:filterProducts(<?= $x ?>, '<?= $search ?>')"><?= $x ?></a>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="javascript:filterProducts(<?= $x ?>, '<?= $search ?>')"><?= $x ?></a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>

                            <li class="page-item">
                                <a class="page-link"
                                   href="javascript:filterProducts(<?= ($page >= $no_of_pages) ? $page : ($page + 1) ?>, '<?= $search ?>')"
                                   aria-label="Next">
                <span aria-hidden="true">
                    <i class="fas fa-chevron-right"></i>
                </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section end -->

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

<!-- Price Filter js -->
<script src="assets/js/price-filter.js"></script>

<!--Plugin JavaScript file-->
<script src="assets/js/ion.rangeSlider.min.js"></script>

<!-- Filter Hide and show Js -->
<script src="assets/js/filter.js"></script>

<!-- Notify js-->
<script src="assets/js/bootstrap/bootstrap-notify.min.js"></script>

<!-- script js -->
<script src="assets/js/theme-setting.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/customer.js"></script>
</body>

</html>