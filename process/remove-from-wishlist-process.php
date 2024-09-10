<?php

require "../MySQL.php";

if ($_GET['wid']) {
    $wishlistId = $_GET['wid'];

    $wishRs = MySQL::search("SELECT * FROM wishlist WHERE id = '$wishlistId'");
    if ($wishRs->num_rows > 0) {
        MySQL::iud("DELETE FROM wishlist WHERE id='$wishlistId'");
        echo "success";
    }else {
        echo "Something went wrong";
    }
}