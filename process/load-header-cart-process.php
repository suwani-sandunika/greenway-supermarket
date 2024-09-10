<?php
require "../MySQL.php";
session_start();

if (isset($_SESSION['user'])) {
    $userEmail = $_SESSION['user'];
} else {
    $userEmail = "";
}
?>

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

?> </span>
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