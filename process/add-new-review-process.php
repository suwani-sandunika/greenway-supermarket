<?php

require "../MySQL.php";

if(isset($_POST['data'])) {
    $data = json_decode($_POST['data']);

    if (empty($data->name)) {
        echo "Please enter the name";
    } else if (empty($data->email)) {
        echo "Please enter the email";
    } else if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
    } else if (empty($data->comment)) {
        echo "Comment should not be empty";
    } else if ($data->ratings == '0') {
        echo "Please select at least 1 star of rating";
    } else {

        $userRs = MySQL::search("SELECT * FROM user WHERE email = '$data->email'");
        if ($userRs->num_rows > 0) {
            $d = new DateTime();
            $d->setTimezone(new DateTimeZone("Asia/Colombo"));
            $dateAdded = $d->format("Y-m-d H:i:s");

            MySQL::iud("INSERT INTO reviews(review, date_added, rating, product_id, user_email) VALUE ('$data->comment', '$dateAdded', '$data->ratings', '$data->pId', '$data->email')");
            echo "success";
        } else {
            echo "user not found";
        }

    }
}