<?php
session_start();
require "../MySQL.php";

$email = $_SESSION['user'];

$cart_rs = MySQL::search("SELECT * FROM cart WHERE user_email='${email}'");
if ($cart_rs->num_rows > 0) {
    MySQL::iud("DELETE FROM cart WHERE user_email='${email}'");
    echo "success";
}
