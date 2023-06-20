<?php

require "connection.php";

session_start();

if (isset($_SESSION["u"])) {

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $line1 = $_POST["li1"];
    $line2 = $_POST["li2"];
    $province = $_POST["pr"];
    $district = $_POST["dr"];
    $city = $_POST["ci"];
    $postal_code = $_POST["pc"];

    if (isset($_FILES["img"])) {

        $image = $_FILES["img"];

        // echo $image["tmp_name"];

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        $file_ex = $image["type"];

        if (!in_array($file_ex, $allowed_image_extentions)) {

            echo "Please Select valid Image.";
        } else {

            $new_image_extention;

            if ($file_ex == "image/jpg") {
                $new_image_extention = ".jpg";
            } else if ($file_ex == "image/jpeg") {
                $new_image_extention = ".jpeg";
            }
            if ($file_ex == "image/png") {
                $new_image_extention = ".png";
            }
            if ($file_ex == "image/jpg") {
                $new_image_extention = ".jpg";
            }
            if ($file_ex == "image/svg+xml") {
                $new_image_extention = ".svg";
            }

            $file_name = "resources//profile_img//" . uniqid() . $new_image_extention;

            move_uploaded_file($image["tmp_name"], $file_name);

            $profile_pic_rs = Database::search("SELECT  * FROM `profile_image` WHERE `users_email` ='" . $_SESSION["u"]["email"] . "'");

            $profile_pic_num = $profile_pic_rs->num_rows;

            if ($profile_pic_num == 1) {

                Database::iud("UPDATE `profile_image` SET `path` = '" . $file_name . "' WHERE `users_email`='" . $_SESSION["u"]["email"] . "'");

                // echo "Profile Image updated Successfully";
            } else {

                Database::iud("INSERT INTO `profile_image` (`path`,`users_email`) VALUES ('" . $file_name . "','" . $_SESSION["u"]["email"] . "')");

                // echo "New Profile Image added Successfully.";
            }
        }
    } else {
    }

    Database::iud("UPDATE `users` SET `fname`='" . $fname . "' , `lname`='" . $lname . "' , `mobile`='" . $mobile . "' WHERE `email`='" . $_SESSION["u"]["email"] . "'");

    echo "User details has updated successfuly";

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='" . $_SESSION["u"]["email"] . "'");

    $address_num = $address_rs->num_rows;

    if ($address_num == 1) {

        Database::iud("UPDATE `user_has_address` SET `line_1`='" . $line1 . "',`line_2`='" . $line2 . "',`city_id`='" . $city . "',`postal_code`='" . $postal_code . "'");

        // echo "Address updated successfully";
    }else{

        Database::iud("INSERT INTO `user_has_address` (`line_1`,`line_2`,`city_id`,`postal_code`) VALUES ('".$line1."','".$line2."','".$city."','".$postal_code."')");

        // echo "Address Saved Sucessfully";

    }
} else {

    echo "please log into your account first";
}

// echo $fname . " " . $lname . " " . $mobile . " " . $line1 . " " . $line2 . " " . $province . " " . $district . " " . $city . " " . $postal_code;
