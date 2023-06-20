<!DOCTYPE html>

<html>

<head>
    <title>eshop | Update Product</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">

            <?php

            require "header.php";

            ?>

            <hr class="hr-break-1">

            <div class="col-12">
                <div class="row">

                    <?php

                    require "connection.php";

                    $product = $_SESSION["p"];
                    if (isset($product)) {

                    ?>

                        <div class="col-12 text-center">
                            <h2 class="h2 text-primary fw-bold">Add new Product</h2>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Category</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" disabled>
                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                                $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                <option><?php echo $category_data["name"] ?></option>
                                                <option>Select Category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Brand</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" disabled>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN 
                                                (SELECT `brand_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");

                                                $brand_data = $brand_rs->fetch_assoc();

                                                ?>
                                                <option><?php echo $brand_data["name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Model</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" disabled>
                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `model` WHERE `id` IN 
                                                (SELECT `model_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");

                                                $model_data = $model_rs->fetch_assoc();

                                                ?>
                                                <option><?php echo $model_data["name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">
                                                Add a title to your Product.
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                            <input type="text" class="form-control" value="<?php echo $product["title"] ?>"  id="ti">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold lbl1">Select Product Condition</label>
                                                </div>

                                                <?php

                                                if ($product["condition_id"] == 1) {

                                                ?>

                                                    <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked disabled>
                                                        <label class="form-check-label" for="bn">
                                                            Brand New
                                                        </label>
                                                    </div>

                                                    <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" disabled>
                                                        <label class="form-check-label" for="us">
                                                            Used
                                                        </label>
                                                    </div>

                                                <?php

                                                } else {

                                                ?>

                                                    <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" disabled>
                                                        <label class="form-check-label" for="bn">
                                                            Brand New
                                                        </label>
                                                    </div>

                                                    <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" checked disabled>
                                                        <label class="form-check-label" for="us">
                                                            Used
                                                        </label>
                                                    </div>

                                                <?php

                                                }

                                                ?>



                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label lbl1 fw-bold">Select Product Color</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">

                                                        <?php

                                                        if ($product["color_id"] == 1) {

                                                        ?>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked disabled>
                                                                <label class="form-check-label" for="clr1">
                                                                    Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr2" disabled>
                                                                <label class="form-check-label" for="clr2">
                                                                    Rose Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr3" disabled>
                                                                <label class="form-check-label" for="clr3">
                                                                    Black
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr4" disabled>
                                                                <label class="form-check-label" for="clr4">
                                                                    Blue
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr5" disabled>
                                                                <label class="form-check-label" for="clr5">
                                                                    Silver
                                                                </label>
                                                            </div>



                                                        <?php

                                                        } else if ($product["color_id"] == 2) {

                                                        ?>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr1" disabled>
                                                                <label class="form-check-label" for="clr1">
                                                                    Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr2" checked disabled>
                                                                <label class="form-check-label" for="clr2">
                                                                    Rose Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr3" disabled>
                                                                <label class="form-check-label" for="clr3">
                                                                    Black
                                                                </label>
                                                            </div>
                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr4" disabled>
                                                                <label class="form-check-label" for="clr4">
                                                                    Blue
                                                                </label>
                                                            </div>
                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr5" disabled>
                                                                <label class="form-check-label" for="clr5">
                                                                    Silver
                                                                </label>
                                                            </div>

                                                        <?php

                                                        } else if ($product["color_id"] == 3) {

                                                        ?>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr1" disabled>
                                                                <label class="form-check-label" for="clr1">
                                                                    Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr2" disabled>
                                                                <label class="form-check-label" for="clr2">
                                                                    Rose Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr3" checked disabled>
                                                                <label class="form-check-label" for="clr3">
                                                                    Black
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr4" disabled>
                                                                <label class="form-check-label" for="clr4">
                                                                    Blue
                                                                </label>
                                                            </div>
                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr5" disabled>
                                                                <label class="form-check-label" for="clr5">
                                                                    Silver
                                                                </label>
                                                            </div>

                                                        <?php

                                                        } else if ($product["color_id"] == 4) {

                                                        ?>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr1" disabled>
                                                                <label class="form-check-label" for="clr1">
                                                                    Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr2" disabled>
                                                                <label class="form-check-label" for="clr2">
                                                                    Rose Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr3" disabled>
                                                                <label class="form-check-label" for="clr3">
                                                                    Black
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr4" checked disabled>
                                                                <label class="form-check-label" for="clr4">
                                                                    Blue
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr5" disabled>
                                                                <label class="form-check-label" for="clr5">
                                                                    Silver
                                                                </label>
                                                            </div>

                                                        <?php

                                                        } else if ($product["color_id"] == 5) {

                                                        ?>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr1" disabled>
                                                                <label class="form-check-label" for="clr1">
                                                                    Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr2" disabled>
                                                                <label class="form-check-label" for="clr2">
                                                                    Rose Gold
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr3" disabled>
                                                                <label class="form-check-label" for="clr3">
                                                                    Black
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr4" disabled>
                                                                <label class="form-check-label" for="clr4">
                                                                    Blue
                                                                </label>
                                                            </div>

                                                            <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class="form-check-input" type="radio" name="clrradio" id="clr5" checked disabled>
                                                                <label class="form-check-label" for="clr5">
                                                                    Silver
                                                                </label>
                                                            </div>

                                                        <?php

                                                        }

                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 col-lg-4">
                                            <div class="row">

                                                <label class="form-label fw-bold lbl1">Add Product Quantity</label>
                                                <input type="number" class="form-control" value="<?php echo $product["qty"] ?>" min="0" id="qty">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-6">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold lbl1">Cost Per Item</label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["price"] ?>" disabled>
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold lbl1">Approved Payment Methods</label>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-2 col-2 pm1"></div>
                                                    <div class="col-2 pm2"></div>
                                                    <div class="col-2 pm3"></div>
                                                    <div class="col-2 pm4"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold lbl1">Delivery Cost</label>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">

                                            <div class="col-12 offset-lg-1 col-lg-3">
                                                <label>Delivery Cost Within Colombo</label>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_colombo"] ?>" id="dwc">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">

                                            <div class="col-12 offset-lg-1 col-lg-3">
                                                <label>Delivery Cost out of Colombo</label>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_other"] ?>" id="doc">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold lbl1">Product Description</label>
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" cols="30" rows="25" id="desc"><?php echo $product["description"] ?></textarea>
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold lbl1">Add Product Image</label>
                                    </div>

                                    <div class="col-12 offset-lg-3 col-lg-6">
                                        <?php

                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` IN (SELECT `id` FROM `product` WHERE `id` = '" . $product["id"] . "')");

                                        $image_data = $image_rs->fetch_assoc();

                                        ?>
                                        <div class="row">

                                            <div class="col-4 border border-primary rounded">
                                                <img class="img-fluid" src="<?php echo $image_data["code"] ?>" style="height: 200px;" id="viewImage">
                                            </div>

                                            <div class="col-4 border border-primary rounded">
                                                <img src="resources/addproductimg.svg">
                                            </div>

                                            <div class="col-4 border border-primary rounded">
                                                <img src="resources/addproductimg.svg">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 offset-lg-3 col-lg-6 d-grid mt-3">

                                        <input type="file" accept="img/*" class="d-none" id="imageuploder" multiple>
                                        <label for="imageuploder" class="col-12 btn btn-primary" onclick="changeProductImage1();">Upload Image</label>

                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <label class="form-label fw-bold lbl1">Notice...</label>
                                <br>
                                <label class="form-label">We are taking 5% of the product from price from every product as a service charge.</label>
                            </div>

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3 mt-2">
                                <button class="btn btn-success fw-bold" onclick="updateProduct();">Update Product</button>
                            </div>


                        </div>
                </div>

            </div>

            <?php

                        require "footer.php";

            ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<?php
                    }
?>