<?php

session_start();

require "connection.php";

if (isset($_SESSION["p"])) {

    $product_id = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];
    //$image = $_POST["i"];
    //$image = $_FILES["i"];


    Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',
    `delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "',
    `description`='" . $description . "' WHERE `id`='" . $product_id . "' ");

    echo "Product Updated Successfully.";

    $allowed_img_extentions = array("image/jpg", "image/png", "image/svg+xml");

    if (!isset($_FILES["i"])) {
        echo "Invalid image type.";
    } else {

        $image = $_FILES["i"];

        $file_extention = $image["type"];

        if (in_array($file_extention, $allowed_img_extentions)) {


            $newExtention;

            if ($file_extention == "image/jpg") {
                $newExtention = ".jpg";
            } else if ($file_extention == "image/jpeg") {
                $newExtention = ".jpeg";
            } else if ($file_extention == "image/png") {
                $newExtention = ".png";
            } else if ($file_extention == "image/svg+xml") {
                $newExtention = ".svg";
            }

            $file_name = "resources//product_img//" . uniqid() . $newExtention;
            move_uploaded_file($image["tmp_name"], $file_name);

            Database::iud("UPDATE `images` SET `code`='" . $file_name . "' 
                WHERE `product_id`='" . $product_id . "' AND `code`<>'" . $file_name . "' ");
        }
    }
}
