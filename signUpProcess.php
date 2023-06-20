<?php

require "connection.php";


$f = $_POST["f"];
$l = $_POST["l"];
$e = $_POST["e"];
$p = $_POST["p"];
$m = $_POST["m"];
$g = $_POST["g"];

if (empty($f)) {
    echo "Please enter your First Name";
} elseif (strlen($f) > 50) {
    echo "First Name must be less than 50 characters";
} elseif (empty($l)) {
    echo "Please enter your Last Name";
} elseif (strlen($l) > 50) {
    echo "Last Name must be less than 50 characters";
} elseif (empty($e)) {
    echo "Please enter your Email";
} elseif (strlen($e) >= 100) {
    echo "Email must be less than 100 characters";
} elseif (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address";
} elseif (empty($p)) {
    echo "Please enter your Password";
} elseif (strlen($p) < 5 || strlen($p) > 20) {
    echo "Password length should be between 05 and 20";
} elseif (empty($m)) {
    echo "Please Enter Your Mobile Number";
} elseif (strlen($m) != 10) {
    echo "Mobile Number should contain 10 characters";
}elseif(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$m)){
    echo "Invalid Mobile Number";
}else{

    $r = Database::search("SELECT * FROM `users` WHERE `email` = '".$e."' OR `mobile` = '".$m."'");
    $n = $r->num_rows;

    if($n > 0){
        echo "User with the same Email Address or Mobile Number already exists.";
    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `users` (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`status`,`gender_id`) VALUES
        ('".$f."','".$l."','".$e."','".$p."','".$m."','".$date."','1','".$g."')");

        echo "Success";
    }

}
