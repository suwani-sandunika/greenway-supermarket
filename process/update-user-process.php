<?php

require "../MySQL.php";

if (isset($_POST['data'])) {
    $data = json_decode($_POST['data']);

    if(empty($data->fname)) {
        echo "First name cannot be empty";
    }else if(empty($data->lname)) {
        echo "Last name cannot be empty";
    }else if(empty($data->mobile)) {
        echo "Mobile cannot be empty";
    }else if(!preg_match("/07[12456780][0-9]{7}/", $data->mobile)) {
        echo "Invalid mobile number";
    }else {
        $userRs = MySQL::search("SELECT * FROM user WHERE email='$data->email'");
        if ($userRs->num_rows > 0) {
            MySQL::iud("UPDATE user SET fname='$data->fname', lname='$data->lname', mobile='$data->mobile' WHERE email='$data->email'");
            echo "success";
        } else {
            echo "User not found";
        }
    }
}