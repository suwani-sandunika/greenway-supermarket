<?php
require "../../MySQL.php";

$txt = $_GET['txt'] ?? '';

$page = $_GET['page'] ?? 1;

$productsRs = MySQL::search("SELECT *, product.id as pid FROM product JOIN brand b on product.brand_id = b.id JOIN category c on b.category_id = c.id JOIN status s on product.status_id = s.id JOIN unit u on product.unit_id = u.id WHERE product.title LIKE '$txt%' OR brand LIKE '$txt%' OR category LIKE '$txt%' ORDER BY product.id");
$noOfProducts = $productsRs->num_rows;
$productsPerPage = 10;
$noOfPages = ceil($noOfProducts / $productsPerPage);
$viewedProductsCount = ($page - 1) * $productsPerPage;
$productsRs = MySQL::search("SELECT *, product.id as pid FROM product JOIN brand b on product.brand_id = b.id JOIN category c on b.category_id = c.id JOIN status s on product.status_id = s.id JOIN unit u on product.unit_id = u.id WHERE product.title LIKE '$txt%' OR brand LIKE '$txt%' OR category LIKE '$txt%'  ORDER BY product.id LIMIT $productsPerPage OFFSET $viewedProductsCount")

?>

<div class="card-body">
    <div>
        <div class="table-responsive table-desi table-product">
            <table class="table table-1d all-package">
                <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Title</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Published</th>
                    <th>Option</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if ($productsRs->num_rows == 0) {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">Something Went Wrong!</td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>

                    <?php
                } else {

                    while ($product = $productsRs->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $productImgRs = MySQL::search("SELECT * FROM product_images WHERE product_id = " . $product['pid'] . " LIMIT 1");
                                $productImage = $productImgRs->fetch_assoc();
                                ?>
                                <img src="../<?= $productImage['code'] ?>" class="img-fluid"
                                     alt="">
                            </td>

                            <td>
                                <a href="javascript:void(0)"><?= $product['title'] ?></a>
                            </td>

                            <td>
                                <a href="javascript:void(0)"><?= $product['category'] ?></a>
                            </td>

                            <td>
                                <a href="javascript:void(0)"><?= $product['brand'] ?></a>
                            </td>

                            <td>
                                <?= ($product['qty'] > 0) ? "<span class='badge badge-light-danger' style='font-size: 13px'>" . $product['qty'] . " " . $product['unit'] . "</span>" : "<span class='badge badge-light-primary'>OUT OF STOCK</span>" ?>
                            </td>

                            <td class="td-price">Rs.<?= $product['price'] ?></td>

                            <td class="td-cross">
                                <?= (strtolower($product["status"]) == "active") ? "<span class='lnr lnr-checkmark-circle'></span>" : "<span class='lnr lnr-cross-circle'></span>" ?>
                            </td>

                            <td>
                                <ul>
                                    <?php

                                    if (strtolower($product['status']) == "active") {
                                        ?>
                                        <li>
                                            <a href="../product-view.php?product=<?= $product['pid'] ?>"
                                               target="_blank">
                                                <span class="lnr lnr-eye"></span>
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li>
                                            <a href="javascript:void(0)"
                                               target="_blank">
                                                <span class="lnr lnr-eye"></span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                    <li>
                                        <a href="javascript:showProductaUpdateModal('<?= $product['pid'] ?>')">
                                            <span class="lnr lnr-pencil"></span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:updateProductStatus('<?= $product['pid'] ?>')">
                                            <?php
                                            if ($product['status'] == "Active") {
                                                ?>
                                                <span class="lnr lnr-cross-circle text-danger"></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="lnr lnr-checkmark-circle text-danger"></span>
                                                <?php
                                            }
                                            ?>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pagination-box">
    <nav class="ms-auto me-auto " aria-label="...">
        <ul class="pagination pagination-primary">
            <li class="page-item <?= ($page <= 1) ? "disabled" : "" ?>">
                <a class="page-link"
                   href="javascript:searchProducts('<?= ($page - 1 > 0) ? $page - 1 : $page ?>')">Previous</a>
            </li>
            <?php

            for ($x = 1; $x <= $noOfPages; $x++) {
                ?>
                <li class="page-item <?= ($x == $page) ? "active" : "" ?>">
                    <a class="page-link" href="javascript:searchProducts('<?= $x ?>')"><?= $x ?></a>
                </li>
                <?php
            }
            ?>

            <li class="page-item <?= ($page >= $noOfPages) ? "disabled" : "" ?>">
                <a class="page-link"
                   href="javascript:searchProducts('<?= ($page + 1 <= $noOfPages) ? $page + 1 : $page ?>')">Next</a>
            </li>
        </ul>
    </nav>
</div>
