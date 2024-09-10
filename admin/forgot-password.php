<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Greenway - Admin Forgot Password</title>

    <!-- Theme js -->
    <script type="module" async src="assets/js/theme.js"></script>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">


</head>

<body>
    <!-- Forgot password start-->
    <div class="login-section">
        <div class="materialContainer">
            <div class="box">
                <div class="login-title">
                    <h2>Admin Forgot Password</h2>
                </div>
                <div class="input">
                    <label for="fpemail">Enter Email Address</label>
                    <input type="email" class="is-invalid" id="fpemail">
                    <span class="spin"></span>
                </div>

                <span class="text-danger mt-3 fw-bold" id="formErr"></span>

                <div class="button login button-1">
                    <button onclick="forgotPassword();" id="login-btn">
                        <span>Send</span>
                        <i class="fa fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgot password end-->

    <!-- latest jquery-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Theme js-->
    <script src="assets/js/script.js"></script>

    <!-- Admin js -->
    <script src="assets/js/admin.js"></script>
</body>

</html>