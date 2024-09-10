<?php
require_once "../../MySQL.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../../vendor/autoload.php';

$email = $_POST['email'];

if (!empty($email)) {
    $adminRs = MySQL::search("SELECT * FROM admin WHERE email = '$email'");
    if ($adminRs->num_rows > 0) {

        $uid = uniqid("ADMIN_");
        MySQL::iud("UPDATE admin SET verification_code='$uid' WHERE email='$email'");

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'suwanisandunika0723@gmail.com';                     //SMTP username
            $mail->Password = 'gfdyvsgxjpxgjfar';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('suwanisandunika0723@gmail.com', 'GreenWay');
            $mail->addAddress($email);               //Name is optional
            $mail->addReplyTo('suwanisandunika0723@gmail.com', 'GreenWay');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Reset Admin Account Password';
            $mail->Body = '<center style="font-family: sans-serif;">
        <div style="height:auto;padding:50px 50px 50px 50px;background-color:#edeff1"> <br>
            <h1 style="color: #119744;">GreenWay Supermarket</h1><br>
            <div
                style="width:500px;height:auto;margin-top:0px;padding-bottom:80px;font-size:14px;background-color:white;text-align:center">
                <br><br>
                <center>
                    <h2>Request for Admin Password Change!</h2><br>
                    <p>If you forgot your password or wish to <span class="il">reset</span> it,<br>use below link to change
                        your password </p><br>
                    <a href="http://localhost/greenway-supermarket/admin/reset-password.php?code=' . $uid . '"
                        style="width:180px;height:50px;background-color:#119744;padding: 15px 15px; text-align:center;color:white;text-decoration:none; font-size: 18px;font-weight: bold;"
                        target="_blank">
                        Reset Password
                    </a>
                    <br>
                    <br>
                    <p style="color: gray;">If you did not request a password <span class="il">reset</span>, you can safely
                        ignore this mail.
                        <br>
                        your password would not change until you create a new password
                    </p>
                </center>
            </div>
        </div>
    </center>';

            $mail->send();
            echo 'Verification email sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        echo "User with the given email address does not exist";
    }
}else {
    echo "Please enter the email";
}

