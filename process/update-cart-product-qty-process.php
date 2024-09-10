<?php

require "../MySQL.php";
session_start();

$userEmail = $_SESSION['user'];

$pid = $_GET['pid'];
$qty = $_GET['qty'];


$result = new stdClass();

if (empty($qty)) {
    $result->error = "Please enter a quantity of 1 or more";
    $result->qty = $qty;
} else if (preg_match("/-[0-9]+/", $qty)) {
    $result->error = "Quantity must be alteast 1";
    $result->qty = 1;
} else if (!is_numeric($qty)) {
    $result->error = "Quantity should only contain numbers";
    $result->qty = $qty;
} else {
    $productRs = MySQL::search("SELECT * FROM product WHERE id = '$pid'");
    if ($productRs->num_rows > 0) {
        $product = $productRs->fetch_assoc();

        if ($qty <= $product['qty']) {
            MySQL::iud("UPDATE cart SET qty='$qty' WHERE user_email='$userEmail' && product_id='$pid'");
            $result->qty = $qty;
        } else {
            $result->error = "No enough quantity";
            $result->qty = $product['qty'];
        }
    }
}

echo json_encode($result);