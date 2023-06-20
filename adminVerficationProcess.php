<?php

require "connection.php";
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["em"];

if (isset($email)) {

    if (empty($email)) {
        echo "Please Enter Your Email Address";
    } else {

        $adminrs = Database::search("SELECT * FROM `admin` WHERE `aemail`= '" . $email . "' ");
        $admin_num = $adminrs->num_rows;

        if ($admin_num == 1) {

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `code`='" . $code . "' WHERE `aemail`='" . $email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'abc@gmail.com';
            $mail->Password = '*************';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('abc@gmail.com', 'eShop');
            $mail->addReplyTo('abc@gmail.com', 'eShop');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Admin verfication code.';
            $bodyContent = '<h1 style="color:green;">Your Verification code is : ' . $code . '</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {

                echo "Decline email sending failed";
            } else {

                echo "Success";
            }
        } else {
            echo "Email Address not found.";
        }
    }
}
