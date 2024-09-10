<?php
require_once "MySQL.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: unauthorized.php");
    exit();
}

$userEmail = $_SESSION['user'];
$userRs = MySQL::search("SELECT * FROM user JOIN status s on s.id = user.status_id WHERE email='$userEmail'");
$userData = $userRs->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <title>DashBoard</title>

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
                <h3>User Dashboard</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb section end -->

<!-- user dashboard section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <!-- side menu start -->
            <div class="col-lg-3">
                <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                    <li class="nav-item mb-2">
                        <button class="nav-link font-light active" id="tab" data-bs-toggle="tab"
                                data-bs-target="#dash" type="button"><i
                                    class="fas fa-angle-right"></i>Dashboard
                        </button>
                    </li>

                    <li class="nav-item mb-2">
                        <button class="nav-link font-light" id="5-tab" data-bs-toggle="tab"
                                data-bs-target="#profile" type="button"><i
                                    class="fas fa-angle-right"></i>Profile
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link font-light" id="6-tab" data-bs-toggle="tab"
                                data-bs-target="#security" type="button"><i
                                    class="fas fa-angle-right"></i>Security
                        </button>
                    </li>
                </ul>
            </div>
            <!-- side menu end -->

            <div class="col-lg-9">
                <div class="filter-button dash-filter dashboard">
                    <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="dash">
                        <div class="dashboard-right">
                            <div class="dashboard">
                                <div class="page-title title title1 title-effect">
                                    <h2>My Dashboard</h2>
                                </div>
                                <div class="welcome-msg">
                                    <h6 class="font-light">Hello,
                                        <span><?= $userData['fname'] . ' ' . $userData['lname'] ?> !</span></h6>
                                    <p class="font-light">From your My Account Dashboard you have the ability to
                                        view a snapshot of your recent account activity and update your account
                                        information. Select a link below to view or edit information.</p>
                                </div>

                                <div class="order-box-contain my-4">
                                    <div class="row g-4">
                                        <!-- total orders start -->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="order-box">
                                                <div class="order-box-image">
                                                    <img src="assets/images/svg/box.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                                <div class="order-box-contain">
                                                    <img src="assets/images/svg/box1.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                    <div>
                                                        <h5 class="font-light">total order</h5>
                                                        <h3><?= MySQL::search("SELECT * FROM invoice WHERE user_email='$userEmail'")->num_rows ?></h3>
                                                        <!--TODO: load total number of orders -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- total orders start -->

                                        <!-- pending orders start -->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="order-box">
                                                <div class="order-box-image">
                                                    <img src="assets/images/svg/sent.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                                <div class="order-box-contain">
                                                    <img src="assets/images/svg/sent1.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                    <div>
                                                        <h5 class="font-light">pending orders</h5>
                                                        <h3><?= MySQL::search("SELECT * FROM invoice WHERE user_email='$userEmail' AND status='1'")->num_rows ?></h3>
                                                        <!--TODO: load pending orders -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- pending orders end -->

                                        <!-- wishlist start -->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="order-box">
                                                <div class="order-box-image">
                                                    <img src="assets/images/svg/wishlist.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                                <div class="order-box-contain">
                                                    <img src="assets/images/svg/wishlist1.png"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                    <div>
                                                        <h5 class="font-light">wishlist</h5>
                                                        <h3><?= MySQL::search("SELECT * FROM wishlist WHERE user_email='$userEmail'")->num_rows; ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- wishlist end -->
                                    </div>
                                </div>

                                <div class="box-account box-info">
                                    <div class="box-head">
                                        <h3>Account Information</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="box">
                                                <div class="box-title">
                                                    <h4>Contact Information</h4>
                                                    <!--<a href="javascript:void(0)">Edit</a>-->
                                                </div>
                                                <div class="box-content">
                                                    <div class="row g-4">
                                                        <div class="col-sm-6">
                                                            <h6 class="font-light">
                                                                Name: <?= $userData['fname'] . ' ' . $userData['lname']; ?></h6>
                                                            <h6 class="font-light">
                                                                Email: <?= $userData['email']; ?></h6>
                                                            <!--<a href="javascript:void(0)">Change Password</a>-->
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="font-light">
                                                                Mobile: <?= $userData['mobile']; ?></h6>
                                                            <h6 class="font-light">Account
                                                                Created: <?= date_format(date_create($userData['create_time']), "d M, Y H:i A") ?></h6>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="box address-box">
                                            <div class="box-title">
                                                <h4>Address Book</h4>
                                                <!--<a href="javascript:void(0)">Manage Addresses</a>-->
                                            </div>
                                            <div class="box-content">
                                                <div class="row g-4">
                                                    <div class="col-sm-6">
                                                        <h6 class="font-light">Default Billing Address</h6>
                                                        <h6 class="font-light">
                                                            <?php
                                                            $addressRs = MySQL::search("SELECT * FROM address JOIN city c on c.id = address.city_id WHERE user_email='$userEmail'");
                                                            if ($addressRs->num_rows > 0) {
                                                                $address = $addressRs->fetch_assoc();
                                                                echo $address['line1'] . ', ' . $address['line2'] . ', ' . $address['city'] . ', ' . $address['postal_code'] . '.';
                                                            } else {
                                                                echo "No address";
                                                            }
                                                            ?>
                                                        </h6>
                                                        <!--<a href="javascript:void(0)">Edit Address</a>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade dashboard-profile dashboard" id="profile">
                        <div class="box-head">
                            <h3>Profile</h3>
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                               data-bs-target="#userprofile">Edit</a>
                        </div>
                        <ul class="dash-profile">
                            <li>
                                <div class="left">
                                    <h6 class="font-light">Name</h6>
                                </div>
                                <div class="right">
                                    <h6><?= $userData['fname'] . ' ' . $userData['lname']; ?></h6>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Email</h6>
                                </div>
                                <div class="right">
                                    <h6><?= $userData['email']; ?></h6>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Mobile</h6>
                                </div>
                                <div class="right">
                                    <h6><?= $userData['mobile']; ?></h6>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Account Status</h6>
                                </div>
                                <div class="right">
                                    <h6><?= $userData['status']; ?></h6>
                                </div>
                            </li>

                        </ul>

                        <div class="box-head mt-3">
                            <h3>Address</h3>
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                               data-bs-target="#updateAddress">Edit</a>
                        </div>
                        <ul class="dash-profile">
                            <li>
                                <div class="left">
                                    <h6 class="font-light">Address</h6>
                                </div>
                                <div class="right">
                                    <h6>
                                        <?php
                                        mysqli_data_seek($addressRs, 0);
                                        if ($addressRs->num_rows > 0) {
                                            $address = $addressRs->fetch_assoc();
                                            echo $address['line1'] . ', ' . $address['line2'];
                                        } else {
                                            echo "No address";
                                        }
                                        ?>
                                    </h6>
                                </div>
                            </li>

                            <li>
                                <div class="left mb-2">
                                    <h6 class="font-light">City/State</h6>
                                </div>
                                <div class="right">
                                    <?php
                                    mysqli_data_seek($addressRs, 0);
                                    if ($addressRs->num_rows > 0) {
                                        $address = $addressRs->fetch_assoc();
                                        echo $address['city'];
                                    } else {
                                        echo "No address";
                                    }
                                    ?>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Postal Code</h6>
                                </div>
                                <div class="right">
                                    <?php
                                    mysqli_data_seek($addressRs, 0);
                                    if ($addressRs->num_rows > 0) {
                                        $address = $addressRs->fetch_assoc();
                                        echo $address['postal_code'];
                                    } else {
                                        echo "No address";
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>

                        <!--<div class="box-head mt-lg-5 mt-3">-->
                        <!--    <h3>Login Details</h3>-->
                        <!--    <a href="javascript:void(0)" data-bs-toggle="modal"-->
                        <!--       data-bs-target="#updateAddress">Edit</a>-->
                        <!--</div>-->
                        <!---->
                        <!--<ul class="dash-profile">-->
                        <!--    <div>-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="currentpwd" class="form-label font-light">Current Password</label>-->
                        <!--            <input type="password" class="form-control" id="currentpwd" style="height: 32px">-->
                        <!--        </div>-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="newpwd" class="form-label font-light">New Password</label>-->
                        <!--            <input type="password" class="form-control" id="newpwd" style="height: 32px">-->
                        <!--        </div>-->
                        <!--        <div>-->
                        <!--            <label for="confirmpwd" class="form-label font-light">Confirm Password</label>-->
                        <!--            <input type="password" class="form-control" id="confirmpwd" style="height: 32px">-->
                        <!--        </div>-->
                        <!--        <div>-->
                        <!--            <span class="text-danger my-2" id="formerr"></span>-->
                        <!--        </div>-->
                        <!--        <div>-->
                        <!--            <button class="btn btn-solid-default rounded-1" onclick="resetUserPassword();">Reset-->
                        <!--                Password-->
                        <!--            </button>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</ul>-->
                    </div>

                    <!-- TODO: delete account -->
                    <div class="tab-pane fade dashboard-security dashboard" id="security">
                        <div class="box-head">
                            <h3>Delete Your Account</h3>
                        </div>
                        <div class="security-details">
                            <h5 class="font-light mt-3">Hi
                                <span> <?= $userData['fname'] . ' ' . $userData['lname'] ?>,</span>
                            </h5>
                            <p class="font-light mt-1">We Are Sorry To Here You Would Like To Delete Your Account.
                            </p>
                        </div>

                        <div class="security-details-1 mb-0">
                            <div class="page-title">
                                <h4 class="fw-bold">Note</h4>
                            </div>
                            <p class="font-light">Deleting your account will permanently remove your profile,
                                personal settings, and all other associated information. Once your account is
                                deleted, You will be logged out and will be unable to log back in.</p>

                            <p class="font-light mb-4">If you understand and agree to the above statement, and would
                                still like to delete your account, than click below</p>

                            <button class="btn btn-danger btn-sm fw-bold rounded" data-bs-target="#deleteModal"
                                    data-bs-toggle="modal">Delete Your Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- user dashboard section end -->

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


<!-- add / update address start -->
<div class="modal fade reset-email-modal" id="updateAddress">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Update Address</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-3">

                <?php
                mysqli_data_seek($addressRs, 0);
                if ($addressRs->num_rows > 0) {
                    $addressData = $addressRs->fetch_assoc();
                    ?>
                    <div>
                        <div class="mb-3">
                            <label for="line1" class="form-label font-light">Line 01</label>
                            <input type="text" class="form-control" id="line1" value="<?= $addressData['line1'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="line2" class="form-label font-light">Line 02</label>
                            <input type="text" class="form-control" id="line2" value="<?= $addressData['line2'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label font-light">City</label>
                            <select class="form-select" id="city">
                                <option value="0">Select City</option>
                                <?php
                                $cityRs = MySQL::search("SELECT * FROM city");
                                while ($cityData = $cityRs->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $cityData['id'] ?>" <?= ($cityData['id'] == $addressData['city_id']) ? "selected" : "" ?>><?= $cityData['city'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <span class="text-danger" id="u-formerr"></span>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div>
                        <div class="mb-3">
                            <label for="line1" class="form-label font-light">Line 01</label>
                            <input type="text" class="form-control" id="line1">
                        </div>
                        <div class="mb-3">
                            <label for="line2" class="form-label font-light">Line 02</label>
                            <input type="text" class="form-control" id="line2">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label font-light">City</label>
                            <select class="form-select" id="city">
                                <option value="0">Select City</option>
                                <?php
                                $cityRs = MySQL::search("SELECT * FROM city");
                                while ($cityData = $cityRs->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $cityData['id'] ?>"><?= $cityData['city'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <span class="text-danger" id="u-formerr"></span>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
            <div class="modal-footer pt-0">
                <button class="btn bg-secondary rounded-1 modal-close-button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-solid-default rounded-1" onclick="updateAddress()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- add / update address end -->

<!-- user update modal start -->
<div class="modal fade reset-email-modal" id="userprofile">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Update Profile</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-3">
                <div>
                    <div class="mb-3">
                        <label for="fname" class="form-label font-light">First Name</label>
                        <input type="text" class="form-control" id="u-fname" value="<?= $userData['fname'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label font-light">Last Name</label>
                        <input type="text" class="form-control" id="u-lname" value="<?= $userData['lname'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label font-light">Mobile</label>
                        <input type="tel" class="form-control" id="u-mobile" value="<?= $userData['mobile'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label font-light">Email</label>
                        <input type="email" class="form-control" id="u-email" value="<?= $userData['email'] ?>"
                               disabled>
                    </div>
                    <div>
                        <span class="text-danger" id="u-formerr"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button class="btn bg-secondary rounded-1 modal-close-button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-solid-default rounded-1" onclick="updateUserProfile();">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- user update modal end -->

<!-- Comfirm Delete Modal Start -->
<div class="modal delete-account-modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pb-3 text-center mt-4">
                <h4>Are you sure you want to delete your account?</h4>
            </div>
            <div class="modal-footer d-block text-center mb-4">
                <button class="btn m-1 btn-outline-danger fw-bold rounded" onclick="deleteUserAccount()">Yes Delete
                    account
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Comfirm Delete Modal End -->

<!-- toast start -->
<div class="toast-container position-fixed end-0 top-0 p-3 zi-1">
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

<!-- Filter Hide and show Js -->
<script src="assets/js/filter.js"></script>

<!-- Notify js-->
<script src="assets/js/bootstrap/bootstrap-notify.min.js"></script>

<!-- script js -->
<script src="assets/js/script.js"></script>
<script src="assets/js/customer.js"></script>

</body>

</html>