<?php

require "../MySQL.php";

$qty = $_GET['qty']+1;
$pid = $_GET['pid'];

if (isset($qty) && isset($pid)) {
    $result = new stdClass();

    $productRs = MySQL::search("SELECT * FROM product WHERE id = '$pid'");
    if ($productRs->num_rows > 0) {
        $product = $productRs->fetch_assoc();

        if ($product['qty'] >= $qty) {
            $result->qty = $qty;
        } else {
            $result->error = "No enough quantity";
            $result->qty = $qty-1;
        }
    }

    echo json_encode($result);
}

