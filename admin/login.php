<?php
session_start();
if (isset($_SESSION['admin'])) {
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
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>GreenWay - Admin Login</title>

    <!-- Google font -->
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">

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
<!-- login page start-->
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-section">
                <div class="materialContainer">
                    <div class="box">

                        <div class="login-title">
                            <h2>Admin Login</h2>
                        </div>
                        <div class="input">
                            <label for="email">Email Address</label>
                            <input type="email" name="name" id="email" />
                            <span class="spin"></span>
                        </div>

                        <div class="input">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" id="pass">
                            <span class="spin"></span>
                        </div>

                        <span class="text-danger mt-3" id="formErr"></span>

                        <div class="row">
                            <div class="col-12 mt-3 text-end">
                                <a href="forgot-password.php" class="text-end">Forgot password?</a>
                            </div>
                        </div>

                        <div class="button login">
                            <button onclick="signIn();" id="login-btn">
                                <span>Log In</span>
                                <i class="fa fa-check"></i>
                            </button>
                        </div>

                        <p class="sign-category">
                            <span>All rights reserved by <a href="javascript:void();">Greenway</a></span>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Theme js-->
    <script src="assets/js/script.js"></script>

    <!-- Admin js -->
    <script src="assets/js/admin.js"></script>
</div>
</body>

</html>