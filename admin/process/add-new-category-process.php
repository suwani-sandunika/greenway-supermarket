<?php

require "../../MySQL.php";

if(isset($_GET["category"]) && !empty($_GET["category"])) {
    $category = $_GET["category"];

    $categoryRs = MySQL::search("SELECT * FROM category WHERE category='$category'");

    if($categoryRs->num_rows > 0) {
        echo "Sorry, this category already exists";
    } else {
            MySQL::iud("INSERT INTO category (category) VALUES ('$category')");
        echo "Category Added Successfully";
    }
}else {
    echo "Please enter a category";
}