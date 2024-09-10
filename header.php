<?php
require_once "MySQL.php";
?>

<!-- header start -->
<header id="home">

    <div class="top-header top-header-black">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-auto d-xl-block d-none">
                    <ul class="border-list">
                        <li>GreenWay Supermarket</li>
                        <li>New Customer Extra 50% Off</li>
                    </ul>
                </div>

                <div class="col-auto">
                    <ul class="border-list">
                        <?php

                        if (!isset($_SESSION['user'])) {
                            ?>
                            <li>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0)" role="button"
                                       id="dropdownMenuLink" data-bs-toggle="dropdown">
                                        <span><strong class="text-success">Login</strong> & Register</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                        <li class="w-100">
                                            <a class="dropdown-item" href="log-in.php">Log In</a>
                                        </li>
                                        <li class="w-100">
                                            <a class="dropdown-item" href="sign-up.php">Register</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        } else {
                            $userEmail = $_SESSION['user'];
                            $user = MySQL::search("SELECT * FROM user WHERE email='$userEmail'")->fetch_assoc();
                            ?>
                            <li>
                                <a href="javascript:void(0)">Welcome, <span
                                            class="text-success"><?= $user['fname'] . ' ' . $user['lname'] ?></span></a>
                            </li>
                            <li>
                                <a href="sign-out-process.php" class="text-danger">
                                    Sign Out
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main-header search-header navbar-searchbar">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <!-- brand name start -->
                            <div class="brand-logo">
                                <a href="index.php" class="d-flex">
                                    <svg class="svg-icon">
                                        <use class="fill-color" xlink:href="assets/svg/icons.svg#logo"></use>
                                    </svg>
                                    <span class="greenway fw-bolder fs-5">GreenWay</span>
                                </a>
                            </div>
                            <!-- brand name end -->

                            <!-- all categories start -->
                            <div class="category-menu">
                                <button type="button"
                                        class="btn btn-solid-default toggle-category d-sm-block d-none">
                                    All categories
                                    <i class="fas fa-chevron-down d-xl-inline-block d-none"></i>
                                </button>

                                <div class="category-dropdown">
                                    <div class="close-btn d-xl-none">
                                        Category List
                                        <span class="back-category"><i class="fa fa-angle-left"></i>
                                            </span>
                                    </div>

                                    <ul>
                                        <?php
                                        $categoryRs = MySQL::search("SELECT * FROM category");
                                        while ($cat = $categoryRs->fetch_assoc()) {
                                            ?>
                                            <li>
                                                <a href="javascript:void(0)"><?= $cat["category"] ?></a>
                                            </li>
                                            <?php
                                        }

                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- all categories end -->
                        </div>

                        <!-- search box start -->
                        <div class="search-box1 d-lg-block d-none">
                            <form action="shop.php" method="get">

                                <div class="input-group">
                                    <input type="text" class="form-control typeahead" id="exampleInputPassword1"
                                           placeholder="Search a Product" name="search" required
                                           value="<?= (isset($_GET['search']) ? $_GET['search'] : "") ?>">
                                    <button type="submit"
                                            class="input-group-text close-search theme-bg-color search-box">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- search box end -->

                        <div class="menu-right">
                            <ul>
                                <li>
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                </li>
                                <li>
                                    <div class="search-box theme-bg-color d-lg-none d-block">
                                        <i data-feather="search"></i>
                                    </div>
                                </li>

                                <!-- wishlist start -->
                                <li class="onhover-dropdown wislist-dropdown" id="header-wishlist-container">
                                    <?php
                                    $userEmail = "";
                                    if (isset($_SESSION['user'])) {
                                        $userEmail = $_SESSION['user'];
                                    }

                                    $wishRs = MySQL::search("SELECT *, p.id as pid FROM wishlist JOIN product p on p.id = wishlist.product_id WHERE user_email='$userEmail'");
                                    ?>
                                    <div class="cart-media">
                                        <div class="cart-icon">
                                            <i data-feather="heart"></i>
                                            <span class="label label-theme rounded-pill"><?= $wishRs->num_rows ?></span>
                                        </div>
                                        <div class="cart-content">
                                            <h6>My</h6>
                                            <span>Wish List</span>
                                        </div>
                                    </div>

                                    <div class="onhover-div hide-scrollbars"
                                         style="max-height: 500px; overflow: scroll;">
                                        <?php
                                        if ($wishRs->num_rows > 0) {

                                            ?>
                                            <div class="cart-menu">
                                                <div class="cart-title">
                                                    <div class="cart-icon">
                                                        <span class="label label-theme rounded-pill"><?= $wishRs->num_rows; ?></span>
                                                    </div>
                                                </div>
                                                <ul class="custom-scroll">
                                                    <?php
                                                    while ($wishItem = $wishRs->fetch_assoc()) {
                                                        if ($wishItem["status_id"] == 2) {
                                                            continue;
                                                        }
                                                        ?>
                                                        <li>
                                                            <a href="product-view.php?product=<?= $wishItem['pid'] ?>">
                                                                <div class="media">
                                                                    <?php
                                                                    $wishImg = MySQL::search("SELECT * FROM product_images WHERE product_id='${wishItem['pid']}'");
                                                                    $img = $wishImg->fetch_assoc();
                                                                    ?>
                                                                    <img src="<?= $img['code'] ?>"
                                                                         class="img-fluid blur-up lazyload" alt="">
                                                                    <div class="media-body">
                                                                        <h6><?= $wishItem['title'] ?></h6>
                                                                        <div class="qty-with-price">
                                                                            <span>Rs.<?= $wishItem['price'] ?></span>
                                                                            <span><?= ($wishItem > 0) ? "In Stock" : "Out of Stock" ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button"
                                                                            class="btn-close d-block d-md-none"
                                                                            aria-label="Close">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </a>

                                                        </li>
                                                        <?php
                                                    }
                                                    ?>


                                                </ul>
                                            </div>
                                            <div class="cart-btn">
                                                <button onclick="location.href = 'wishlist.php';" type="button"
                                                        class="btn btn-solid-default btn-block">
                                                    My Wishlist
                                                </button>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="wislist-empty">
                                                <i class="fab fa-gratipay"></i>
                                                <h6 class="mb-1">Your wislist empty !!</h6>
                                                <p class="font-light mb-0">explore more and shortlist items.</p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </li>
                                <!-- wishlist end -->

                                <!-- cart start -->
                                <li class="onhover-dropdown cart-dropdown" id="header-cart-container">
                                    <button type="button" class="btn btn-solid-default btn-spacing">
                                        <i data-feather="shopping-cart" class="pe-2"></i>
                                        <span>
                                            <?php

                                            $cartRs = MySQL::search("SELECT *, cart.qty as qty FROM cart JOIN product p on p.id = cart.product_id WHERE user_email='$userEmail'");

                                            if ($cartRs->num_rows > 0) {
                                                $total = 0;
                                                while ($cartProd = $cartRs->fetch_assoc()) {
                                                    $total += ($cartProd['qty'] * $cartProd['price']);
                                                }
                                                echo "Rs." . $total . "";
                                            } else {
                                                echo "Cart is Empty";
                                            }

                                            ?>
                                        </span>
                                    </button>
                                    <div class="onhover-div">
                                        <div class="cart-menu hide-scrollbars"
                                             style="max-height: 500px; overflow: scroll">
                                            <div class="cart-title">
                                                <h6>
                                                    <i data-feather="shopping-bag"></i>
                                                    <span class="label label-theme rounded-pill"><?= $cartRs->num_rows; ?></span>
                                                </h6>
                                            </div>
                                            <ul class="custom-scroll">
                                                <?php

                                                mysqli_data_seek($cartRs, 0);
                                                if ($cartRs->num_rows > 0) {
                                                    while ($cproduct = $cartRs->fetch_assoc()) {
                                                        if ($cproduct["status_id"] == 2) {
                                                            continue;
                                                        }
                                                        ?>

                                                        <li>
                                                            <div class="media">
                                                                <?php
                                                                $cartProdImgRs = MySQL::search("SELECT * FROM product_images WHERE product_id='${cproduct['product_id']}'");
                                                                $cartProdImg = $cartProdImgRs->fetch_assoc();
                                                                ?>
                                                                <img src="<?= $cartProdImg['code'] ?>"
                                                                     class="img-fluid blur-up lazyload" alt="">
                                                                <div class="media-body">
                                                                    <h6><?= $cproduct['title'] ?></h6>
                                                                    <div class="qty-with-price">
                                                                        <span>Rs.<?= $cproduct['price'] * $cproduct['qty'] ?></span>
                                                                        <span>
                                                                       QTY - <span><?= $cproduct['qty'] ?></span>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                                <button type="button"
                                                                        class="btn-close d-block d-md-none"
                                                                        aria-label="Close">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </li>


                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <li class="text-center">
                                                        <i class="fs-5 text-muted fa fa-shopping-bag"></i>
                                                        <p class="fs-5 text-muted">Cart is Empty</p>
                                                    </li>
                                                    <?php
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                        <div class="cart-btn">
                                            <button onclick="location.href = 'cart.php';" type="button"
                                                    class="btn btn-solid-default btn-block">
                                                Go to Shopping Cart
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <!-- cart end -->
                            </ul>
                        </div>

                        <!-- search full start -->
                        <form action="shop.php" method="get">
                            <div class="search-full">
                                <div class="input-group">
                                    <button type="submit" class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </button>
                                    <input type="text" class="form-control search-type" placeholder="Search here.."
                                           name="search">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!-- search full end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- main header start -->
    <!--<div class="main-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <ul class="nav-menu">
                                        <li class="back-btn d-xl-none">
                                            <div class="close-btn">
                                                Menu
                                                <span class="mobile-back"><i class="fa fa-angle-left"></i>
                                                    </span>
                                            </div>
                                        </li>
                                        <li class="mega-menu home-menu">
                                            <a href="index.php" class="nav-link">home</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="javascript:void(0)" class="nav-link menu-title">Account</a>
                                            <ul class="nav-submenu menu-content">
                                                <li>
                                                    <a href="shop-canvas-filter.html"><i class="fa fa-shopping-cart"></i> Shopping Cart</a>
                                                </li>
                                                <li>
                                                    <a href="shop-category-slider.html"><i class="fa fa-heartbeat"></i> WishList</a>
                                                </li>
                                                <li>
                                                    <a href="shop-filter-hide.html"><i class="fa fa-clock"></i> Order History</a>
                                                </li>
                                                <li>
                                                    <a href="shop-filter-hide.html"><i class="fa fa-user-cog"></i> User Profile</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

    <div class="main-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <ul class="nav-menu">
                                        <li class="back-btn d-xl-none">
                                            <div class="close-btn">
                                                Menu
                                                <span class="mobile-back"><i class="fa fa-angle-left"></i>
                                                    </span>
                                            </div>
                                        </li>
                                        <li class="mega-menu home-menu">
                                            <a href="index.php" class="nav-link"><i class="fa fa-home"></i> home</a>
                                        </li>
                                        <li>
                                            <a href="cart.php"><i class="fa fa-shopping-cart"></i>
                                                Shopping Cart</a>
                                        </li>
                                        <li>
                                            <a href="wishlist.php"><i class="fa fa-hand-holding-heart"></i>
                                                WishList</a>
                                        </li>
                                        <li>
                                            <a href="order-history.php"><i class="fa fa-clock"></i> Order
                                                History</a>
                                        </li>
                                        <li>
                                            <a href="user-dashboard.php"><i class="fa fa-user-cog"></i> User Profile</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main header start -->
</header>
<!-- header end -->