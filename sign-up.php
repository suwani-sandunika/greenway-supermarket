<?php
session_start();

if(isset($_SESSION['user'])) {
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
    <title>GreenWay - Sign Up</title>

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

<body class="signup-page theme-color6">

<!-- Sign Up Section Start -->
<div class="login-section">
    <div class="materialContainer">
            <div class="box">
                <div class="login-title">
                    <h2>Register</h2>
                </div>

                <div class="input">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname">
                    <span class="mt-3 text-danger" id="fNameErr"></span>
                </div>

                <div class="input">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname">
                    <span class="mt-3 text-danger" id="lNameErr"></span>
                </div>

                <div class="input">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email">
                    <span class="mt-3 text-danger" id="emailErr"></span>
                </div>

                <div class="input">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile">
                    <span class="mt-3 text-danger" id="mobileErr"></span>
                </div>

                <div class="input">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" id="pass">
                    <span class="mt-3 text-danger" id="passErr"></span>
                </div>

                <div class="input">
                    <label for="cpass">Confirm Password</label>
                    <input type="password" name="pass" id="cpass">
                    <span class="mt-3 text-danger" id="cPassErr"></span>
                </div>

                <div class="button login mt-5">
                    <button onclick="signUp();" id="sign-up-btn">
                        <span>Sign Up</span>
                        <i class="fa fa-check"></i>
                    </button>
                </div>

                <p><a href="log-in.php" class="theme-color">Already have an account?</a></p>
            </div>
    </div>
</div>
<!-- Sign Up Section End -->

<div class="bg-overlay"></div>

<!-- latest jquery-->
<script src="assets/js/jquery-3.5.1.min.js"></script>

<!-- Bootstrap js-->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- lazyload js-->
<script src="assets/js/lazysizes.min.js"></script>

<!-- feather icon js-->
<script src="assets/js/feather/feather.min.js"></script>

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