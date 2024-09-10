<?php

require "../MySQL.php";

$qty = $_GET['qty'] - 1;
$pid = $_GET['pid'];

if (isset($qty) && isset($pid)) {
    $result = new stdClass();

    $productRs = MySQL::search("SELECT * FROM product WHERE id = '$pid'");
    if ($productRs->num_rows > 0) {
        $product = $productRs->fetch_assoc();

        if($qty <= 0) {
            $result->error = "Quantity cannot be 0";
            $result->qty = 1;
        }else if ($qty <= $product['qty']) {
            $result->qty = $qty;
        } else {
            $result->error = "No enough quantity";
            $result->qty = $qty;
        }
    }

    echo json_encode($result);
}

