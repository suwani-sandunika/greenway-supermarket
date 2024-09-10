<?php

require "../../MySQL.php";

if(!empty($_GET['category'])) {
    $category = $_GET["category"];
    $brandsRs = MySQL::search("SELECT * FROM brand WHERE category_id = '$category'");
    $json = $brandsRs->fetch_all(MYSQLI_ASSOC);
    echo json_encode($json);
}