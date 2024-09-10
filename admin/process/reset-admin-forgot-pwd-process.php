<?php

require "../../MySQL.php";

$code = $_POST['code'];
$newPass = "123";
$confirmPass = $_POST['confirmPass'];


if ($newPass != $confirmPass) {
    echo "Passwords do not match";
} else {
    $sql = "SELECT * FROM admin WHERE verification_code = '$code'";
    $result = MySQL::search($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $newPassHashed = password_hash($newPass, PASSWORD_DEFAULT);
        $sql = "UPDATE admin SET password = '$newPassHashed', verification_code = '' WHERE email = '$email'";
        if (MySQL::iud($sql)) {
            echo "Password reset successfully";
        } else {
            echo "Something went wrong";
        }
    } else {
        echo "Invalid reset code";
    }
}