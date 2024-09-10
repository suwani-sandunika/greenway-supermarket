<?php

require "../../MySQL.php";

if (isset($_GET['brand']) && !empty($_GET['brand']) && isset($_GET['category']) && !empty($_GET['category'])) {
    $brand = $_GET['brand'];
    $category = $_GET['category'];

    $brandRs = MySQL::search("SELECT * FROM brand WHERE brand='$brand' AND category_id='$category'");
    if ($brandRs->num_rows > 0) {
        echo "Sorry, this brand already exists";
    } else {
        MySQL::iud("INSERT INTO brand (brand, category_id) VALUES ('$brand', '$category')");
        echo "Brand Added Successfully";
    }
}else {
    echo "Please enter a brand";
}