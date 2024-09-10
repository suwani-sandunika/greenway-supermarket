<?php
require "../MySQL.php";
session_start();

if (isset($_GET['pid']) && isset($_SESSION['user'])) {
    $userEmail = $_SESSION['user'];
    $productId = $_GET['pid'];

    $wishlistRs = MySQL::search("SELECT * FROM wishlist WHERE product_id='$productId' AND user_email='$userEmail'");

    if ($wishlistRs->num_rows > 0) {
        echo "exists";
    } else {
        MySQL::iud("INSERT INTO wishlist(product_id, user_email) VALUE ('$productId', '$userEmail')");
        echo "success";
    }
}else {
    echo "login";
}