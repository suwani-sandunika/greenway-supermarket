<?php

require "../../MySQL.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    if (isset($_GET["category"]) && !empty($_GET["category"])) {
        $id = $_GET['id'];
        $category = $_GET["category"];
        $categoryRs = MySQL::search("SELECT * FROM category WHERE id = '$id'");
        if ($categoryRs->num_rows > 0) {
            MySQL::iud("UPDATE category SET category = '$category' WHERE id = '$id'");
            echo "Category Updated Successfully";
        }else {
            echo "Category Not Found";
        }
    } else {
        echo "Category is not set";
    }
} else {
    echo "ID is not set";
}