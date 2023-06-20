<?php

require "connection.php";

session_start();

$id = $_GET["id"];

if (isset($id)) {

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `code`='" . $id . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {

        $admin_data = $admin_rs->fetch_assoc();

        $_SESSION["a"] = $admin_data;

        echo "Success";
    } else {
        echo "verfication code Not Valid";
    }
} else {
    echo "Please enter Your verficcation code";
}
