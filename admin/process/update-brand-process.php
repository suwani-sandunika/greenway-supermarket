<?php

require "../../MySQL.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    if (isset($_GET["brand"]) && !empty($_GET["brand"])) {
        $id = $_GET['id'];
        $brand = $_GET["brand"];

        $brandRs = MySQL::search("SELECT * FROM brand WHERE id = '$id'");
        if ($brandRs->num_rows > 0) {
            MySQL::iud("UPDATE brand SET brand = '$brand' WHERE id = '$id'");
            echo "Brand Updated Successfully";
        }else {
            echo "Brand Not Found";
        }
    } else {
        echo "Brand is not set";
    }
} else {
    echo "ID is not set";
}
