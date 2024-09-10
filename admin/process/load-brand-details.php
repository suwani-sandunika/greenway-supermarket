<?php

require "../../MySQL.php";

if (isset($_GET['brand']) && !empty($_GET['brand'])) {
    $id = $_GET['brand'];

    $brandRs = MySQL::search("SELECT * FROM brand WHERE id='$id'");
    if ($brandRs->num_rows > 0) {
        $brand = $brandRs->fetch_assoc();
        echo json_encode($brand);
    } else {
        echo json_encode(array("error" => "Brand not found."));
    }
}

