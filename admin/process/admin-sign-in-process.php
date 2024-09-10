<?php
require_once "../../MySQL.php";

$email = $_POST['email'];
$pass = $_POST['pass'];

if (empty($email)) {
    echo "Email cannot be empty";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
} else if (empty($pass)) {
    echo "Password cannot be empty";
} else {
    $adminRs = MySQL::search("SELECT email,fname, lname,mobile, create_time, password FROM admin WHERE email = '$email'");
    if ($adminRs->num_rows > 0) {
        $admin = $adminRs->fetch_assoc();
        $hashedPassword = $admin['password'];

        if (password_verify($pass, $hashedPassword)) {
            session_start();
            $_SESSION['admin'] = $admin;
            echo "success";
        }else {
            echo "Login failed. Password is incorrect";
        }
    } else {
        echo "Login failed. User could not be found";
    }
}