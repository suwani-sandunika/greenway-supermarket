<?php

require "../MySQL.php";

$npass = $_POST['npass'];
$cpass = $_POST['cpass'];
$vcode = $_POST['vcode'];

if ($npass != $cpass) {
    echo "Password doesn't match";
} else if (empty($vcode)) {
    echo "Verification Failed";
} else {
    $userRs = MySQL::search("SELECT * FROM user WHERE verification_code='$vcode'");
    if ($userRs->num_rows > 0) {
        $userData = $userRs->fetch_assoc();
        $userEmail = $userData['email'];

        $hashedPass = password_hash($npass, PASSWORD_DEFAULT);

        MySQL::iud("UPDATE user SET password='$hashedPass', verification_code = null WHERE email='$userEmail'");
        echo "success";
    }

}

