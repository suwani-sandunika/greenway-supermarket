<?php

require "../../MySQL.php";

if(isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = $_GET['id'];

    $categoryRs = MySQL::search("SELECT * FROM category WHERE id = '$id'");
    if($categoryRs->num_rows > 0) {
        $brandsRs = MySQL::search("SELECT * FROM brand WHERE category_id = '$id'");
        if($brandsRs->num_rows > 0) {
            echo "Category is In Use";
        }else {
            MySQL::iud("DELETE FROM category WHERE id = '$id'");
            echo "Category Deleted Successfully";
        }
    }else {
        echo "Category Not Found";
    }
}else {
    echo "ID is not set";
}