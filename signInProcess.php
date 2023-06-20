<?php

session_start();

require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberMe = $_POST["rm"];

if (empty($email)) {
    echo "Please enter your Email Address.";
} elseif (strlen($email) > 100) {
    echo "Email Address should contain less than 100 characters.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address.";
} elseif (empty($password)) {
    echo "Please enter your Password.";
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo "Invalid Password.";
} else {

    $resultset = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $password . "'");

    $n = $resultset->num_rows;

    if ($n == 1) {
        echo "success";
        
        $d = $resultset->fetch_assoc();
        $_SESSION["u"] = $d;

        if ($rememberMe == "true") {

            setcookie("email", $email, time() + (60 * 60 * 24 * 365));
            setcookie("password", $password, time() + (60 * 60 * 24 * 365));
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }
    } else {
        echo "Invalid Email or Password";
    }
}
