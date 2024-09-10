<?php

require "../../MySQL.php";

if(isset($_GET['category']) && !empty($_GET['category'])) {
    $id = $_GET['category'];

    $categoryRs = MySQL::search("SELECT * FROM category WHERE id='$id'");
    if($categoryRs->num_rows > 0) {
        $category = $categoryRs->fetch_assoc();
        echo json_encode($category);
    } else {
        echo json_encode(array("error" => "Category not found."));
    }
}
