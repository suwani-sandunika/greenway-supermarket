<?php
require "../MySQL.php";
session_start();

$userEmail = $_SESSION['user'];

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

<div class="onhover-div">
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