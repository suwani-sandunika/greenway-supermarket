<?php

require "../../MySQL.php";

if(isset($_GET['product'])) {
    $json = array();
    $productId = $_GET['product'];

    $productRs = MySQL::search("SELECT *, product.id as pid FROM product JOIN brand b on b.id = product.brand_id JOIN category c on c.id = b.category_id JOIN status s on product.status_id = s.id JOIN unit u on product.unit_id = u.id WHERE product.id = '$productId'");
    $product = $productRs->fetch_assoc();
    $json["productDetails"] = $product;

    $productImagesRs = MySQL::search("SELECT * FROM product_images WHERE product_id = '$productId'");
    while ($productImages = $productImagesRs->fetch_assoc()) {
        $json["productImages"][] = $productImages;
    }

    echo json_encode($json);
}