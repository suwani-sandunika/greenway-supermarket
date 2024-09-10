<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon/6.png" type="image/x-icon"/>
    <title>GreenWay - Log In</title>

    <!--Google font-->
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


<!-- Log In Section Start -->
<div class="login-section">
    <div class="materialContainer">
        <div class="box">
            <div class="login-title">
                <h2>Login</h2>
            </div>
            <div class="input">
                <label <?= (isset($_COOKIE['e']) && $_COOKIE['e'] != '') ? 'style="line-height: 18px; font-weight: 100; top: 0px;"' : '' ?>
                        for="email">Email Address</label>
                <input type="text" name="email" id="email" required
                       value="<?= (isset($_COOKIE['e'])) ? $_COOKIE['e'] : "" ?>">

            </div>

            <div class="input">
                <label <?= (isset($_COOKIE['p']) && $_COOKIE['p'] != '') ? 'style="line-height: 18px; font-weight: 100; top: 0px;"' : '' ?>
                        for="pass">Password</label>
                <input type="password" name="pass" id="pass" value="<?= (isset($_COOKIE['p'])) ? $_COOKIE['p'] : "" ?>">
            </div>

            <span class="text-danger mt-3" id="formErr"></span>

            <div class="row">
                <div class="col-6 mt-3">
                    <input type="checkbox" id="remember"
                           class="form-check-inline me-2" <?= (isset($_COOKIE['e']) && isset($_COOKIE['p']) ? "checked" : '') ?>>
                    <label for="remember">Remember Me</label>
                </div>
                <div class="col-6 mt-3 text-end">
                    <a href="forgot-password.php" class="text-end">Forgot your password?</a>
                </div>
            </div>

            <div class="button login">
                <button onclick="signIn();" type="submit" id="login-btn">
                    <span>Log In</span>
                    <i class="fa fa-check"></i>
                </button>
            </div>

            <p class="sign-category">
                <span>Or sign in with</span>
            </p>

            <div class="row gx-md-3 gy-3">
                <div class="col-md-6">
                    <a href="#">
                        <div class="social-media fb-media">
                            <img src="assets/images/inner-page/facebook.png" class="img-fluid blur-up lazyload"
                                 alt="">
                            <h6>Facebook</h6>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="#">
                        <div class="social-media google-media">
                            <img src="assets/images/inner-page/google.png" class="img-fluid blur-up lazyload"
                                 alt="">
                            <h6>Google</h6>
                        </div>
                    </a>
                </div>
            </div>

            <p>Not a member? <a href="sign-up.php" class="theme-color">Sign up now</a></p>

        </div>
    </div>
</div>
<!-- Log In Section End -->


<div class="bg-overlay"></div>

<!-- latest jquery-->
<script src="assets/js/jquery-3.5.1.min.js"></script>

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

<!-- Notify js-->
<script src="assets/js/bootstrap/bootstrap-notify.min.js"></script>

<!-- script js -->
<script src="assets/js/script.js"></script>
<script src="assets/js/home-script.js"></script>
<script src="assets/js/customer.js"></script>
</body>
</html>