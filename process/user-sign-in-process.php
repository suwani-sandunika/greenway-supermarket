<?php
require_once "../MySQL.php";

$email = $_POST['email'];
$pass = $_POST['pass'];

if (empty($email)) {
    echo "Email cannot be empty";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
} else if (empty($pass)) {
    echo "Password cannot be empty";
} else {

    $userRs = MySQL::search("SELECT email,fname, lname,mobile, create_time, password FROM user WHERE email = '" . $email . "'");
    if ($userRs->num_rows > 0) {
        $user = $userRs->fetch_assoc();
        $hashedPassword = $user['password'];

        if (password_verify($pass, $hashedPassword)) {
            session_start();
            $_SESSION['user'] = $user['email'];

            if ($_POST['remember'] == 'true') {
                session_set_cookie_params(60 * 60 * 24 * 7);
            } else {
                session_set_cookie_params(60 * 60);
            }

            echo "success";
        } else {
            echo "Please check the email & password";
        }

    } else {
        echo "Please check the email & password";
    }


}