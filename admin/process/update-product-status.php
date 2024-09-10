<?php

require "../../MySQL.php";

if(!empty($_GET["product"])) {
    $product = $_GET["product"];

    $productRs = MySQL::search("SELECT * FROM product WHERE id = '$product'");

    if($productRs->num_rows > 0) {
        $productRow = $productRs->fetch_assoc();
        $status = $productRow["status_id"];

        if($status == 1) {
            $sql = "UPDATE product SET status_id = '2' WHERE id = '$product'";
        }else {
            $sql = "UPDATE product SET status_id = '1' WHERE id = '$product'";
        }

        $result = MySQL::iud($sql);

        if($result) {
            echo "Product Status Updated Successfully";
        } else {
            echo "Product Status Update Failed";
        }
    }
}