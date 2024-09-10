<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

require "../MySQL.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>GreenWay - Products List</title>

    <!-- Google font-->
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="assets/css/linearicon.css">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

    <!-- Theme js -->
    <script type="module" async src="assets/js/theme.js"></script>
</head>

<body>
<!-- tap on top start-->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end-->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include "header.php"; ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include "sidebar.php"; ?>
        <!-- Page Sidebar Ends-->

        <!-- Container-fluid starts-->
        <div class="page-body">
            <div class="title-header title-header-1">
                <h5>Products List</h5>
                <form class="d-flex">
                    <a href="add-new-product.php" class="align-items-center btn btn-primary d-flex gap-2">
                        <i data-feather="plus-square"></i>Add New Product
                    </a>
                </form>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-3">
                                        <span>Search : </span>
                                        <input id="searchTextProducts" type="text" class="form-control"
                                               placeholder="Product Title / Category / Brand" onkeyup="searchProducts(1)">
                                    </div>
                                </div>
                            </div>

                            <?php
                            $page = $_GET['page'] ?? 1;

                            $productsRs = MySQL::search("SELECT *, product.id as pid FROM product JOIN brand b on product.brand_id = b.id JOIN category c on b.category_id = c.id JOIN status s on product.status_id = s.id JOIN unit u on product.unit_id = u.id");
                            $noOfProducts = $productsRs->num_rows;
                            $productsPerPage = 10;
                            $noOfPages = ceil($noOfProducts / $productsPerPage);
                            $viewedProductsCount = ($page - 1) * $productsPerPage;
                            $productsRs = MySQL::search("SELECT *, product.id as pid FROM product JOIN brand b on product.brand_id = b.id JOIN category c on b.category_id = c.id JOIN status s on product.status_id = s.id JOIN unit u on product.unit_id = u.id ORDER BY product.id LIMIT $productsPerPage OFFSET $viewedProductsCount")
                            ?>
                            <div id="searchResults" class="d-flex flex-column">
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
                                                   href="?page=<?= ($page - 1 > 0) ? $page - 1 : $page ?>">Previous</a>
                                            </li>
                                            <?php

                                            for ($x = 1; $x <= $noOfPages; $x++) {
                                                ?>
                                                <li class="page-item <?= ($x == $page) ? "active" : "" ?>">
                                                    <a class="page-link" href="?page=<?= $x ?>"><?= $x ?></a>
                                                </li>
                                                <?php
                                            }
                                            ?>

                                            <li class="page-item <?= ($page >= $noOfPages) ? "disabled" : "" ?>">
                                                <a class="page-link"
                                                   href="?page=<?= ($page + 1 <= $noOfPages) ? $page + 1 : $page ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <div class="container-fluid">
                <!-- footer start-->
                <?php include "footer.php"; ?>
            </div>
        </div>
    </div>
</div>
<!-- page-wrapper End-->

<!-- Modal Start -->
<div class="modal fade" id="updateProduct" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="px-3">
                    <div class="mb-3">
                        <label class="form-label" for="pid">Product ID</label>
                        <input type="text" class="form-control" id="pid" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="ptitle">Product Title</label>
                        <input type="text" class="form-control" id="ptitle" placeholder="Enter Title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pqty">Product QTY</label>
                        <input type="text" class="form-control" id="pqty" placeholder="Enter Qty">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pprice">Price</label>
                        <input type="text" class="form-control" id="pprice" placeholder="Enter Price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pdesc">Product Descrition</label>
                        <textarea type="text" class="form-control" id="pdesc" placeholder="Description..."
                                  rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pcategory">Product Category</label>
                        <select class="form-select" name="" id="pcategory" onchange="changedCategory()">
                            <option value="0">Select Category</option>
                            <?php
                            $categories = MySQL::search("SELECT * FROM category");
                            while ($cat = $categories->fetch_assoc()) {
                                ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['category'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pbrand">Product Brand</label>
                        <select class="form-select" name="" id="pbrand">
                            <option value="0">Select Brand</option>
                            <?php
                            $brands = MySQL::search("SELECT * FROM brand");
                            while ($brand = $brands->fetch_assoc()) {
                                ?>
                                <option value="<?= $brand['id'] ?>"><?= $brand['brand'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="punit">Product Unit</label>
                        <select class="form-select" name="" id="punit">
                            <option value="0">Select Unit</option>
                            <?php
                            $units = MySQL::search("SELECT * FROM unit");
                            while ($unit = $units->fetch_assoc()) {
                                ?>
                                <option value="<?= $unit['id'] ?>"><?= $unit['unit'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 d-flex justify-content-center gap-2" id="productImgContainer"></div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 d-grid">
                                <input id="productImgInput" type="file" class="form-control d-none" multiple
                                       onchange="selectProductImages();">
                                <label for="productImgInput" class="btn btn-danger">SELECT IMAGES</label>
                            </div>
                            <div class="col-6 d-grid">
                                <button class="d-none" onclick="clearSelectedImages()" id="clearSelectedBtn"></button>
                                <label class="btn btn-dark btn-sm" for="clearSelectedBtn">CLEAR SELECTED</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 d-grid">
                        <button class="btn btn-primary" onclick="updateProduct()">UPDATE PRODUCT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- latest js -->
<script src="assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap js -->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- feather icon js -->
<script src="assets/js/icons/feather-icon/feather.min.js"></script>
<script src="assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- scrollbar simplebar js -->
<script src="assets/js/scrollbar/simplebar.js"></script>
<script src="assets/js/scrollbar/custom.js"></script>

<!-- Sidebar js -->
<script src="assets/js/config.js"></script>

<!-- customizer js -->
<script src="assets/js/customizer.js"></script>

<!-- Plugins js -->
<script src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/notify/bootstrap-notify.min.js"></script>
<script src="assets/js/notify/index.js"></script>

<!-- Theme js -->
<script src="assets/js/script.js"></script>
<script src="assets/js/admin.js"></script>
</body>

</html>