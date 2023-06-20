<?php

session_start();

require "connection.php";

$sender = $_SESSION["u"]["email"];
$receiver = $_POST["rm"];
$msg = $_POST["mt"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimeZone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `message` (`from`,`to`,`content`,`date_time`,`status`) VALUES ('".$sender."','".$receiver."','".$msg."','".$date."','0')");

echo "Success";
