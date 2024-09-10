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
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <title>GreenWay - Cart</title>

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
                <h3>Shopping Cart</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb section end -->

<!-- Cart Section Start -->
<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table class="table cart-table">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">image</th>
                        <th scope="col">product name</th>
                        <th scope="col">price</th>
                        <th scope="col">quantity</th>
                        <th scope="col">action</th>
                        <th scope="col">total</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $cartRs = MySQL::search("SELECT *,cart.qty as qty FROM cart JOIN product p on p.id = cart.product_id WHERE user_email='$userEmail'");
                    $total = 0;
                    $noOfProducts = $cartRs->num_rows;
                    if ($noOfProducts > 0) {
                        while ($prod = $cartRs->fetch_assoc()) {

                            if ($prod["status_id"] == 2) {
                                continue;
                            }

                            $total += ($prod['price'] * $prod['qty']);
                            ?>
                            <tr>
                                <td>
                                    <a href="product-view.php?product=<?= $prod['product_id'] ?>">
                                        <?php
                                        $imageRs = MySQL::search("SELECT * FROM product_images WHERE product_id='${prod['product_id']}'");
                                        $image = $imageRs->fetch_assoc();
                                        ?>
                                        <img src="<?= $image['code'] ?>" class=" blur-up lazyload"
                                             alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="product-view.php?product=<?= $prod['product_id'] ?>"><?= $prod['title'] ?></a>
                                    <div class="mobile-cart-content row">
                                        <div class="col">
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <!--TODO: edit here too-->
                                                    <input type="text" name="quantity" class="form-control input-number"
                                                           value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h2>Rs.<?= $prod['price'] ?></h2>
                                        </div>
                                        <div class="col">
                                            <h2 class="td-color">
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h2>Rs.<?= $prod['price'] ?></h2>
                                </td>
                                <td>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input onkeyup="updateCartProductQty('<?= $prod['product_id'] ?>')"
                                                   type="text" id="productQty<?= $prod['product_id'] ?>"
                                                   class="form-control input-number"
                                                   value="<?= $prod['qty'] ?>">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:deleteItemFromCart('<?= $prod['product_id'] ?>')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                                <td>
                                    <h2 class="td-color">Rs.<?= $prod['qty'] * $prod['price'] ?></h2>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td class="text-muted" colspan="6">No Products Added to the Cart</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="col-12 mt-md-5 mt-4">
                <div class="row">
                    <div class="col-sm-7 col-5 order-1">
                        <div class="left-side-button text-end d-flex d-block justify-content-end">
                            <a href="javascript:clearCart();"
                               class="text-decoration-underline theme-color d-block text-capitalize">clear
                                all items</a>
                        </div>
                    </div>
                    <div class="col-sm-5 col-7">
                        <div class="left-side-button float-start">
                            <a href="index.php" class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                                <i class="fas fa-arrow-left"></i> Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-checkout-section">
                <div class="row g-4">
                    <div class="col-lg-4 col-sm-6">
                        <div class="promo-section">
                            <form class="row g-3">
                                <div class="col-7">
                                    <input type="text" class="form-control" id="number" placeholder="Coupon Code">
                                </div>
                                <div class="col-5">
                                    <button class="btn btn-solid-default rounded btn">Apply Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6"></div>

                    <div class="col-lg-4">
                        <div class="cart-box">
                            <div class="cart-box-details">
                                <div class="total-details">
                                    <?php
                                    $deliveryRs = MySQL::search("SELECT * FROM address JOIN city c on c.id = address.city_id WHERE user_email='$userEmail'");
                                    $dfee = 0;
                                    if ($deliveryRs->num_rows > 0) {
                                        $delivery = $deliveryRs->fetch_assoc();
                                        $dfee = $delivery['delivery_fee'];
                                    }
                                    ?>
                                    <div class="top-details">
                                        <h3>Cart Totals</h3>
                                        <h6>Total MRP <span>Rs.<?= $total ?></span></h6>
                                        <h6>Delivery Fee <span>Rs.<?= $dfee ?></span></h6>
                                        <h6>Grand Total <span>Rs.<?= $total + $dfee ?></span></h6>
                                    </div>
                                    <div class="bottom-details">
                                        <?php
                                        if ($deliveryRs->num_rows > 0) {
                                            ?>
                                            <a href="<?= ($cartRs->num_rows > 0) ? "process/create-session.php" : "javascript:alert('Please add products to cart first')" ?>">Process
                                                Checkout</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="user-dashboard.php">First, update the billing address</a>
                                            <?php
                                        }
                                        ?>
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

<div class="bg-overlay"></div>

<!-- latest jquery-->
<script src="assets/js/jquery-3.5.1.min.js"></script>


<!-- Bootstrap js -->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- feather icon js -->
<script src="assets/js/feather/feather.min.js"></script>

<!-- lazyload js -->
<script src="assets/js/lazysizes.min.js"></script>

<!-- Slick js -->
<script src="assets/js/slick/slick.js"></script>
<script src="assets/js/slick/slick-animation.min.js"></script>
<script src="assets/js/slick/custom_slick.js"></script>

<!-- Notify js -->
<script src="assets/js/bootstrap/bootstrap-notify.min.js"></script>

<!-- payhere js -->
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

<!-- script js -->
<script src="assets/js/script.js"></script>
<script src="assets/js/customer.js"></script>

<script src="assets/js/payhere.js"></script>
</body>

</html>