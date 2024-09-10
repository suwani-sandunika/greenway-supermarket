<?php
require_once "../MySQL.php";

if ($_POST['data']) {
    $data = json_decode($_POST['data']);

    $result = new stdClass();
    $result->status = 0;

    $validate = 0;

    if (empty($data->fname)) {
        $result->fNameErr = "First name cannot be empty";
        $validate = 0;
    } else {
        $result->fNameErr = "";
        $validate = 1;
    }

    if (empty($data->lname)) {
        $result->lNameErr = "Last name cannot be empty";
        $validate = 0;
    } else {
        $result->lNameErr = "";
        $validate = 1;
    }

    if (empty($data->email)) {
        $result->emailErr = "Email cannot be empty";
        $validate = 0;
    } else if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
        $result->emailErr = "Invalid email address";
        $validate = 0;
    } else {
        $result->emailErr = "";
        $validate = 1;
    }

    if (empty($data->mobile)) {
        $result->mobileErr = "Mobile cannot be empty";
        $validate = 0;
    } else if (!preg_match("/07[12456780][0-9]{7}/", $data->mobile)) {
        $result->mobileErr = "Invalid mobile number";
        $validate = 0;
    } else {
        $result->mobileErr = "";
        $validate = 1;
    }

    if (empty($data->pass)) {
        $result->passErr = "Password cannot be empty";
        $validate = 0;
    } else {
        $result->passErr = "";
        $validate = 1;
    }

    if (empty($data->cpass)) {
        $result->cPassErr = "Re-enter the password";
        $validate = 0;
    } else if ($data->pass != $data->cpass) {
        $result->cPassErr = "Password doesn't match";
        $validate = 0;
    } else {
        $result->cPassErr = "";
        $validate = 1;
    }

    if ($validate == 1) {
        $userRs = MySQL::search("SELECT * FROM user WHERE email = '" . $data->email . "'");
        if ($userRs->num_rows > 0) {
            $result->cPassErr = "User with the same email address has been already registered";
        } else {
            // Get the create time
            $dateTime = new DateTime();
            $dateTime->setTimezone(new DateTimeZone("Asia/Colombo"));
            $createTime = $dateTime->format("Y-m-d H:i:s");

            // Hash the password
            $hashedPass = password_hash($data->pass, PASSWORD_DEFAULT);

            MySQL::iud("INSERT INTO user(email, password, fname, lname, mobile, create_time) VALUE ('" . $data->email . "','" . $hashedPass . "', '" . $data->fname . "', '" . $data->lname . "', '" . $data->mobile . "','" . $createTime . "')");

            // Log the user with new account
            $userRs2 = MySQL::search("SELECT email,fname,lname,mobile, create_time, password FROM user WHERE email = '" . $data->email . "'");
            $user = $userRs2->fetch_assoc();

            // Add user details to the session
            session_start();
            $_SESSION['user'] = $user;

            $result->status = 1;
        }
    }

    echo json_encode($result);
}