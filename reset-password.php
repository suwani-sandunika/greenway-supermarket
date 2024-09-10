<?php

if(!isset($_GET['vcode'])) {
    header("Location: 404.php");
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
    <title>GreenWay - Reset Password</title>

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
                <h2>Reset Password</h2>
            </div>

            <div class="input">
                <label for="npass">New Password</label>
                <input type="password" id="npass" />
            </div>

            <div class="input">
                <label for="cpass">Confirm Password</label>
                <input type="password" id="cpass" />
            </div>

            <span class="text-danger mt-3" id="formErr"></span>

            <div class="button login">
                <button onclick="resetFpPassword('<?= $_GET['vcode']; ?>');" type="submit">
                    <span>Reset Password</span>
                    <i class="fa fa-check"></i>
                </button>
            </div>

            <p><a href="log-in.php" class="theme-color">Go to Login</a></p>
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