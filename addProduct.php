<!DOCTYPE html>

<html>

<head>
    <title>eshop | Add Product</title>

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

            require "connection.php";

            if (isset($_SESSION["u"])) {

            ?>

                <hr class="hr-break-1">

                <div class="col-12">
                    <div class="row">

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
                                            <select class="form-select" id="pc">
                                                <option value="0">Select Category</option>

                                                <?php

                                                $categoryrs = Database::search("SELECT * FROM `category`");
                                                $category_num = $categoryrs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $categoryrs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>

                                                <?php

                                                }

                                                ?>

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
                                            <select class="form-select" id="pb">
                                                <option value="0">Select Brand</option>

                                                <?php

                                                $brandrs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brandrs->num_rows;

                                                for ($y = 0; $y < $brand_num; $y++) {
                                                    $brand_data = $brandrs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $brand_data["id"] ?>"><?php echo $brand_data["name"] ?></option>

                                                <?php
                                                }

                                                ?>

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
                                            <select class="form-select" id="pm">
                                                <option value="0">Select Model</option>

                                                <?php

                                                $modelrs = Database::search("SELECT * FROM `model`");
                                                $model_num = $modelrs->num_rows;

                                                for ($z = 0; $z < $model_num; $z++) {
                                                    $model_data = $modelrs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $model_data["id"];?>"><?php echo $model_data["name"];?></option>

                                                <?php
                                                }

                                                ?>

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
                                            <input type="text" class="form-control" id="title">
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
                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked>
                                                    <label class="form-check-label" for="bn">
                                                        Brand New
                                                    </label>
                                                </div>

                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="us">
                                                    <label class="form-check-label" for="us">
                                                        Used
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label lbl1 fw-bold">Select Product Color</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked>
                                                            <label class="form-check-label" for="clr1">
                                                                Gold
                                                            </label>
                                                        </div>
                                                        <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class="form-check-input" type="radio" name="clrradio" id="clr2" checked>
                                                            <label class="form-check-label" for="clr2">
                                                                Black
                                                            </label>
                                                        </div>
                                                        <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class="form-check-input" type="radio" name="clrradio" id="clr3" checked>
                                                            <label class="form-check-label" for="clr3">
                                                                White
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="row">

                                                <label class="form-label fw-bold lbl1">Add Product Quantity</label>
                                                <input type="number" class="form-control" value="0" min="0" id="qty">
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
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
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
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc">
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
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
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
                                        <textarea class="form-control" cols="30" rows="25" id="description"></textarea>
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
                                        <div class="row">

                                            <div class="col-4 border border-primary rounded">
                                                <img class="img-fluid" src="resources/addproductimg.svg" id="preview0" style="width: 250px; background-position: center;">
                                            </div>

                                            <div class="col-4 border border-primary rounded">
                                                <img class="img-fluid" src="resources/addproductimg.svg" id="preview1" style="width: 250px; background-position: center;">
                                            </div>

                                            <div class="col-4 border border-primary rounded">
                                                <img class="img-fluid" src="resources/addproductimg.svg" id="preview2" style="width: 250px; background-position: center;">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 offset-lg-3 col-lg-6 d-grid mt-3">

                                        <input type="file" accept="img/*" class="d-none" id="imageuploder" multiple>
                                        <label for="imageuploder" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Image</label>

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
                                <button class="btn btn-success fw-bold" onclick="addproduct();">Add Product</button>
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

            } else {

                header("location:index.php");
            }

?>