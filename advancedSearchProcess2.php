<?php

require "connection.php";

$search_txt = $_POST["s"];
$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["c1"];
$color = $_POST["c2"];
$price_from = $_POST["p1"];
$price_to = $_POST["p2"];
$sort = $_POST["s1"];

$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 0) {

    if (!empty($search_txt)) {

        $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {

        $query .= " WHERE `category_id`='" . $category . "'";
        $status = 1;
    } else if ($category != 0 && $status == 1) {

        $query .= " AND `category_id`='" . $category . "'";
    }

    $pid = 0;

    if ($brand != 0 && $model == 0) {

        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE 
        `brand_id`='" . $brand . "'");

        $n = $modelHasBrand_rs->num_rows;
        for ($x = 0; $x < $n; $x++) {
            $d = $modelHasBrand_rs->fetch_assoc();
            $pid = $d["id"];

        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status == 1) {
            $query .= " AND `model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($brand == 0 && $model != 0) {

        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE 
        `model_id`='" . $model . "'");

        $n = $modelHasBrand_rs->num_rows;
        for ($x = 0; $x < $n; $x++) {
            $d = $modelHasBrand_rs->fetch_assoc();
            $pid = $d["id"];

        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status == 1) {
            $query .= " AND `model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($brand != 0 && $model != 0) {

        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE 
         `model_id`='" . $model . "' AND `brand_id`='" . $brand . "'");

        $n = $modelHasBrand_rs->num_rows;
        for ($x = 0; $x < $n; $x++) {
            $d = $modelHasBrand_rs->fetch_assoc();
            $pid = $d["id"];

        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status == 1) {
            $query .= " AND `model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($colour != "0" && $status == 0) {
        $query .=  "WHERE `color_id`='" . $colour . "'";
        $status = 1;
    } else if ($colour != "0" && $status == 1) {
    
        $query .= "AND `color_id`='" . $colour . "'";
    }

    if (!empty($price_from) && empty($price_to)) {

        if($status == 0){
            $query .= "WHERE `price` >= '" . $price_from . "'";
            $status = 1;
        }else if($status == 1){
            $query .= "AND `price` >= '" . $price_from . "'";
        }

    } else if (empty($price_from) && !empty($price_to)) {

        if($status == 0){
            $query .= "WHERE `price` <= '" . $price_to . "'";
            $status = 1;
        }else if($status == 1){
            $query .= "AND `price` <= '" . $price_to . "'";
        }
        
    } else if (!empty($price_from) && !empty($price_to)) {

        if($status == 0){
            $query .= "WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
            $status = 1;
        }else if($status == 1){
            $query .= "AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        }
        
    }

    

} else if ($sort == 1) {
    if (!empty($search_txt)) {

        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `price` DESC";
        $status = 1;
    }
} else if ($sort == 2) {
} else if ($sort == 3) {
} else if ($sort == 4) {
}

$product = Database::search($query);
$n = $product->num_rows;

for ($x = 0; $x < $n; $x++) {
    $d = $product->fetch_assoc();
    echo ($d["title"]);
}
