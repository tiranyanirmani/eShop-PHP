<?php

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $resultset = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");

    $n = $resultset->num_rows;

    if ($n == 1) {

        $code = uniqid();
        Database::iud("UPDATE `users` SET `verfication_code` = '".$code."' WHERE `email`='".$email."'" );

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'abc@gmail.com'; 
            $mail->Password = '**************'; //email password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('abc@gmail.com', 'eShop'); 
            $mail->addReplyTo('abc@gmail.com', 'eShop'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);
            $mail->Subject = 'eShop Forget Password verification code.'; 
            $bodyContent = '<h1 style="color:green;">Your Verification code is : '.$code.'</h1>'; 
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }


    } else {
        echo "Email Address not found.";
    }
} else {
    echo "Please Enter Your Email Address.";
}
