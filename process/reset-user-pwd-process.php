<?php

require "../MySQL.php";
session_start();

if (isset($_POST['data'])) {
    $data = json_decode($_POST['data']);

    if (empty($data->current)) {
        echo "Current password cannot be empty";
    } else if (empty($data->new)) {
        echo "New password cannot be empty";
    } else if (empty($data->confirm)) {
        echo "Re-enter the password";
    } else if ($data->new !== $data->confirm) {
        echo "Password doesnt match";
    } else {
        $userEmail = $_SESSION['user'];
        $userRs = MySQL::search("SELECT * FROM user WHERE `email`='$userEmail' AND `password`='$data->current'");

        if ($userRs->num_rows > 0) {
            MySQL::iud("UPDATE user SET password = '$data->new' WHERE email='$userEmail'");
            echo "success";
        } else {
            echo "User not found";
        }
    }
}