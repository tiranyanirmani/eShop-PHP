<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $uemail = $_SESSION["u"]["email"];

        $cartProduct_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "' AND `product_id`='" . $pid . "' ");
        $cartProduct_num = $cartProduct_rs->num_rows;

        $productQty_rs = Database::search("SELECT `qty` FROM `product` WHERE `id`='" . $pid . "'");
        $productQty_data = $productQty_rs->fetch_assoc();

        $productQty = $productQty_data["qty"];

        if ($cartProduct_num == 1) {

            $cartProduct_Data = $cartProduct_rs->fetch_assoc();
            $currentQty = $cartProduct_Data["qty"];
            $newQty = (int)$currentQty + 1;

            if ($productQty >= $newQty) {

                Database::iud("UPDATE `cart` SET `qty`='" . $newQty . "' WHERE `user_email`='" . $uemail . "' AND `product_id`='" . $pid . "' ");

                echo "Product Quantity Updated.";
            } else {
                echo "Sorry for the delay.";
            }
        } else {
            Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`) VALUES ('" . $pid . "','" . $uemail . "','1')");

            echo "New Product Added to the cart";
        }
    } else {
        echo "Sorry for the Inconvenience";
    }
} else {
    echo "Please Log In or Sign Up";
}
