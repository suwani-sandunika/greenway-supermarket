<?php

require "../MySQL.php";
session_start();
$userEmail = $_SESSION['user'];

MySQL::iud("DELETE FROM address WHERE user_email='$userEmail'");
MySQL::iud("DELETE FROM cart WHERE user_email='$userEmail'");
MySQL::iud("DELETE FROM wishlist WHERE user_email='$userEmail'");
MySQL::iud("DELETE FROM reviews WHERE user_email='$userEmail'");


$invRs = MySQL::search("SELECT * FROM invoice WHERE user_email='$userEmail'");
if ($invRs->num_rows > 0) {
    while ($invData = $invRs->fetch_assoc()) {
        MySQL::iud("DELETE FROM invoice_item WHERE invoice_invoice_id='${invData['invoice_id']}'");
    }
}
MySQL::iud("DELETE FROM invoice WHERE user_email='$userEmail'");

MySQL::iud("DELETE FROM user WHERE email='$userEmail'");

$_SESSION['user'] = null;
session_destroy();
echo "success";