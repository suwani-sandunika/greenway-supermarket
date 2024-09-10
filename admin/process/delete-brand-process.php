<?php


require "../../MySQL.php";

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = $_GET['id'];

    $brandRs = MySQL::search("SELECT * FROM brand WHERE id = '$id'");
    if ($brandRs->num_rows > 0) {
        $productRs = MySQL::search("SELECT * FROM product WHERE brand_id = '$id'");
        if ($productRs->num_rows > 0) {
            echo "Brand is In Use";
        } else {
            MySQL::iud("DELETE FROM brand WHERE id = '$id'");
            echo "Brand Deleted Successfully";
        }
    } else {
        echo "Brand Not Found";
    }
} else {
    echo "ID is not set";
}