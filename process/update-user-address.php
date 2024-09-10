<?php

require "../MySQL.php";
session_start();

$userEmail = $_SESSION['user'];

$data = json_decode($_POST['data']);

if (empty($data->line1)) {
    echo "Please enter the address line 1";
} else if (empty($data->line2)) {
    echo "Please enter the address line 2";
} else if ($data->city == '0') {
    echo "Please select a city";
} else {

    $userRs = MySQL::search("SELECT * FROM user WHERE email='$userEmail'");
    if ($userRs->num_rows > 0) {
        $addressRs = MySQL::search("SELECT * FROM address WHERE user_email='$userEmail'");
        if ($addressRs->num_rows > 0) {
            $addressData = $addressRs->fetch_assoc();
            MySQL::iud("UPDATE address SET line1='$data->line1', line2='$data->line2', city_id='$data->city' WHERE id='".$addressData['id']."'");
        } else {
            MySQL::iud("INSERT INTO address(line1, line2, city_id, user_email) VALUE ('$data->line1', '$data->line2', '$data->city', '$userEmail')");
        }

        echo "success";
    } else {
        echo "User not found";
    }
}