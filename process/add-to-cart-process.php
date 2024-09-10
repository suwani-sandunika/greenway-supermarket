<?php

session_start();
require "../MySQL.php";

if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];

    $pid = $_GET["pid"];
    if (isset($_GET['qty'])) {
        $qty = $_GET["qty"];
    } else {
        $qty = 1;
    }

    $rs = MySQL::search("SELECT * FROM `product` WHERE id='$pid'");

    if ($rs->num_rows > 0) {
        $product_data = $rs->fetch_assoc();

        $cart_rs = MySQL::search("SELECT * FROM `cart` WHERE `product_id` = '" . $pid . "' && `user_email` = '" . $email . "'");
        if ($cart_rs->num_rows > 0) {
            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = $current_qty + $qty;

            if ($product_data["qty"] >= $new_qty) {
                MySQL::iud("UPDATE `cart` SET `qty` = '" . $new_qty . "' WHERE `id` = '" . $cart_data["id"] . "'");
                echo "Product quantity updated";
            } else {
                echo "Insufficient Quantity";
            }

        } else {
            MySQL::iud("INSERT INTO `cart`(`product_id`, `user_email`, `qty`) VALUES ('" . $pid . "', '" . $email . "', '" . $qty . "')");
            echo "Product added to the cart";
        }
    }
} else {
    echo "Please login first";
}

