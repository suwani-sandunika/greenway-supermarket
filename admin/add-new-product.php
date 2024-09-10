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
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>GreenWay - Add New Product</title>

    <!-- Google font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="assets/css/linearicon.css">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">

    <!--Dropzon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/dropzone.css">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/date-picker.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap-tagsinput.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

    <!-- Theme js -->
    <script type="module" async src="assets/js/theme.js"></script>

</head>

<body>
<!-- tap on top start -->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end -->

<!-- page-wrapper start -->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">
    <!-- Page Header start -->
    <?php include "header.php"; ?>
    <!-- Page Header end -->

    <!-- Page Body start -->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include "sidebar.php"; ?>
        <!-- Page Sidebar Ends-->

        <div class="page-body">

            <div class="title-header title-header-1">
                <h5>Add New Product</h5>
                <form class="d-inline-flex">
                    <button type="button" class="align-items-center btn btn-primary d-flex gap-2" data-bs-toggle="modal"
                            data-bs-target="#AddNewcategoryOrBrandModal">
                        <i data-feather="plus-square"></i>Add New Category/Brand
                    </button>
                </form>
            </div>

            <!-- New Product Add Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="theme-form theme-form-2 mega-form" onsubmit="addProduct(event)">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header-2">
                                                <h5>Product Information</h5>

                                            </div>

                                            <div class="row">
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-2 mb-0">Product
                                                        Title</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text"
                                                               placeholder="Product Name" id="title">
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-2 mb-0">Price</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="number"
                                                               placeholder="Product Price" id="price">
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="col-sm-2 col-form-label form-label-title">Category</label>
                                                    <div class="col-sm-10">
                                                        <select class="js-example-basic-single w-100" id="category"
                                                                onchange="loadBrands()">
                                                            <option disabled>Category Menu</option>
                                                            <?php
                                                            $categoryRs = MySQL::search("SELECT * FROM category");
                                                            $firstCategoryId = null;
                                                            for ($x = 0; $x < $categoryRs->num_rows; $x++) {
                                                                $category = $categoryRs->fetch_assoc();
                                                                if ($x == 0) {
                                                                    $firstCategoryId = $category["id"];
                                                                }
                                                                ?>
                                                                <option value="<?= $category['id'] ?>"><?= $category["category"] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                            class="col-sm-2 col-form-label form-label-title">Brand</label>
                                                    <div class="col-sm-10">
                                                        <select class="js-example-basic-single w-100" id="brand">
                                                            <option disabled>Brand Menu</option>
                                                            <?php
                                                            $brandRs = MySQL::search("SELECT * FROM brand WHERE category_id = $firstCategoryId");
                                                            while ($brand = $brandRs->fetch_assoc()) {
                                                                ?>
                                                                <option value="<?= $brand['id'] ?>"><?= $brand["brand"] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                            class="col-sm-2 col-form-label form-label-title">Until</label>
                                                    <div class="col-sm-10">
                                                        <select class="js-example-basic-single w-100" id="unit">
                                                            <option disabled>Until Menu</option>
                                                            <?php
                                                            $unitsRs = MySQL::search("SELECT * FROM unit");
                                                            while ($unit = $unitsRs->fetch_assoc()) {
                                                                ?>
                                                                <option value="<?= $unit['id'] ?>"><?= $unit["unit"] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-2 mb-0" for="qty">Product
                                                        Quantity</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="number"
                                                               placeholder="Product quantity" id="qty">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header-2">
                                                <h5>Description</h5>
                                            </div>

                                            <textarea rows="10" style="width: 100%;"
                                                      placeholder="Enter the product description here"
                                                      id="desc"></textarea>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header-2">
                                                <h5>Product Images</h5>
                                            </div>

                                            <div class="row">
                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                            class="col-sm-2 col-form-label form-label-title">Images</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control form-choose" type="file"
                                                               id="productImages" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="row align-items-center">
                                                    <div class="col-8 offset-2 d-grid">
                                                        <button class="btn btn-primary fs-6">Add
                                                            Product
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New Product Add End -->

            <!-- footer Start -->
            <?php include "footer.php"; ?>
            <!-- footer En -->
        </div>
        <!-- Container-fluid End -->
    </div>
    <!-- Page Body End -->
</div>
<!-- page-wrapper End -->

<!-- Add New Category/Brand Modal -->

<!-- Modal -->
<div class="modal fade" id="AddNewcategoryOrBrandModal" tabindex="-1" aria-labelledby="AddNewcategoryOrBrandModal"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add new Category / Brand</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Nav Links -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="javascript:void(0)" data-bs-toggle="tab"
                           data-bs-target="#category-tab-pane" type="button" role="tab">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-bs-toggle="tab"
                           data-bs-target="#brand-tab-pane" type="button" role="tab">Brand</a>
                    </li>
                </ul>
                <!-- Nav Links -->

                <!-- Tab Contents -->
                <div class="tab-content p-3" id="myTabContent">

                    <!-- Category -->
                    <div class="tab-pane fade show active" id="category-tab-pane" role="tabpanel"
                         aria-labelledby="home-tab"
                         tabindex="0">
                        <div class="mb-4 row align-items-center">

                            <div class="col-sm-12">
                                <div class="theme-form theme-form-2 mega-form">
                                    <div class="mb-3">
                                        <label class="col-sm-2 col-form-label form-label-title">Category</label>
                                        <input class="form-control" type="text" placeholder="Category name"
                                               id="newCategory">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" onclick="addNewCategory()">Add new category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Category -->

                    <!-- Brand -->
                    <div class="tab-pane fade" id="brand-tab-pane" role="tabpanel"
                         tabindex="0">
                        <div class="mb-4 row align-items-center">
                            <div class="col-sm-12">
                                <div class="theme-form theme-form-2 mega-form">

                                    <div class="mb-3">
                                        <label class="col-sm-2 col-form-label form-label-title">Brand</label>
                                        <input class="form-control" type="text" placeholder="Brand name" id="newBrand">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Select Category</label>
                                        <select class="form-select" id="newBrandCategory">
                                            <option value="0" disabled>Categories Menu</option>
                                            <?php
                                            $categoryRs = MySQL::search("SELECT * FROM category");
                                            $firstCategoryId = null;
                                            for ($x = 0; $x < $categoryRs->num_rows; $x++) {
                                                $category = $categoryRs->fetch_assoc();
                                                if ($x == 0) {
                                                    $firstCategoryId = $category["id"];
                                                }
                                                ?>
                                                <option value="<?= $category['id'] ?>"><?= $category["category"] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" onclick="addNewBrand()">Add new brand</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Brand -->
                </div>
                <!-- Tab Contents -->
            </div>
        </div>
    </div>
    <!-- Add New Category/Brand Modal -->

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

    <!-- bootstrap tag-input js -->
    <script src="assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>

    <!-- customizer js -->
    <script src="assets/js/customizer.js"></script>

    <!--Dropzon js -->
    <script src="assets/js/dropzone/dropzone.js"></script>
    <script src="assets/js/dropzone/dropzone-script.js"></script>

    <!-- Plugins js -->
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/notify/index.js"></script>

    <!-- select2 js -->
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/select2-custom.js"></script>

    <!-- Theme js -->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/admin.js"></script>
</body>

</html>