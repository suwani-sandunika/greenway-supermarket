<?php

require "../../MySQL.php";
$productId = $_GET['product'];

$json = array();
if (!empty($productId)) {
    $productImages = MySQL::search("SELECT * FROM product_images WHERE product_id = '$productId'")->fetch_all(MYSQLI_ASSOC);
    $json['productImages'] = $productImages;
    $json['success'] = "true";
    echo json_encode($json);
}
