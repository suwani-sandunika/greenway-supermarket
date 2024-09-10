<div class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
    <?php
    require "../MySQL.php";

    $data = json_decode($_POST['data']);

    $categories = implode(",", $data->categories);
    $brands = implode(",", $data->brands);
    $minPrice = $data->price[0];
    $maxPrice = $data->price[1];

    if ($data->page == "0") {
        $page = 1;
    } else {
        $page = $data->page;
    }
    $search = $data->search;

    $query = "SELECT *, product.id AS `pid` , unit.`unit` AS `unit_name` FROM `product` INNER JOIN `status` ON product.status_id = `status`.id INNER JOIN unit ON product.unit_id = unit.id JOIN brand b on b.id = product.brand_id WHERE product.title LIKE '%$search%' AND status_id = '1' ";

    if (!empty($minPrice) && empty($maxPrice)) {
        $query .= "AND price >= '${minPrice}' ";
    } else if (empty($minPrice) && !empty($maxPrice)) {
        $query .= "AND price <= '${maxPrice}' ";
    } else if (!empty($minPrice) && !empty($maxPrice)) {
        $query .= "AND price BETWEEN '${minPrice}' AND '${maxPrice}' ";
    }

    if ($brands != "") {
        $query .= "AND brand_id IN (${brands}) ";
    }

    if ($categories != "") {
        $query .= "AND category_id IN (${categories}) ";
    }

    $product_rs = MySQL::search($query);
    $no_of_products = $product_rs->num_rows;
    $results_per_page = 12;
    $no_of_pages = ceil($no_of_products / $results_per_page);
    $viewed_result_count = ((int)$page - 1) * $results_per_page;

    $product_rs2 = MySQL::search($query . " LIMIT ${results_per_page} OFFSET ${viewed_result_count}");

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
                            <img src="<?= $image['code'] ?>" style="height: 250px;"
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
                        <button id="<?= $productData['pid'] ?>" class="btn listing-content addToCart">
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
                    <a class="page-link" href="javascript:filterProducts(<?= $x ?>, '<?= $search ?>')"><?= $x ?></a>
                </li>
                <?php
            } else {
                ?>
                <li class="page-item">
                    <a class="page-link" href="javascript:filterProducts(<?= $x ?>, '<?= $search ?>')"><?= $x ?></a>
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