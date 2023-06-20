<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>eShop | Cart</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php

            require "header.php";

            if (isset($_SESSION["u"])) {
                $uemail = $_SESSION["u"]["email"];

                $total = 0;
                $subTotal = 0;
                $shipping = 0;

            ?>

                <div class="col-12 pt-2" style="background-color: #E3E5E4;">



                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>

                </div>

                <div class="col-12 border border-0 border-secondary rounded mb-3">
                    <div class="row">
                        <label class="col-12 fs-1 fw-bold">Basket <i class="bi bi-cart3 fs-2"></i></label>
                    </div>

                    <div class="col-12 col-lg-6">
                        <hr class="hr-break-1">
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-6  offset-lg-2  mt-3 mb-3">
                                <input type="text" class="form-control" placeholder="Search in Basket...">
                            </div>
                            <div class="col-12 col-lg-2  d-grid gap-2">
                                <button class="btn btn-outline-primary mt-3 mb-3">Search</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hr-break-1">
                        </div>

                        <?php

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {

                        ?>
                            <!-- empty -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>

                                    <div class="col-12 text-center mb-2">
                                        <img src="resources/emptycart.svg" class="img-fluid" style="height: 400px;">
                                    </div>

                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1">You have no items in your basket.</label>
                                    </div>

                                    <div class="col-12 col-lg-4 offset-0 offset-lg-4 d-grid mb-4">
                                        <a href="home.php" class="btn btn-primary fs-5">Start Shopping</a>
                                    </div>

                                </div>
                            </div>
                            <!-- empty -->

                            <?php

                        } else {

                            for ($x = 0; $x < $cart_num; $x++) {
                                $cart_data = $cart_rs->fetch_assoc();

                                $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                `id`='" . $cart_data["product_id"] . "'");

                                $product_data = $product_rs->fetch_assoc();

                                $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='" . $uemail . "'");
                                $address_data = $address_rs->fetch_assoc();

                                $city_id = $address_data["city_id"];

                                $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
                                $district_data = $district_rs->fetch_assoc();
                                $district_id = $district_data["district_id"];

                                $ship = 0;

                                if ($district_id == 1) {

                                    $ship = $product_data["delivery_fee_colombo"];
                                    $shipping = $shipping + $ship;
                                } else {
                                    $ship = $product_data["delivery_fee_other"];
                                    $shipping = $shipping + $ship;
                                }

                                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");
                                $user_data = $user_rs->fetch_assoc();

                            ?>

                                <!-- have product -->
                                <div class="col-12 col-lg-12">
                                    <div class="row">

                                        <div class="card mb-3 mx-0 col-12 col-lg-9">
                                            <div class="row g-0">

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">

                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span>&nbsp;

                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-4">

                                                    <?php

                                                    $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();

                                                    ?>

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"] ?>" title="Product Description">
                                                        <img src="<?php echo $img_data["code"] ?>" class="img-fluid" style="max-width: 200px;">
                                                    </span>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                        <?php
                                                        $color_rs = Database::search("SELECT * FROM `color` JOIN `product` ON `product`.`color_id`=`color`.`id` WHERE `product`.`id`='" . $product_data["id"] . "'");
                                                        $color_data = $color_rs->fetch_assoc();
                                                        ?>

                                                        <span class="fw-bold text-black-50">Colour : <?php echo $color_data["name"] ?></span>&nbsp; |
                                                        &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo "Brand New"; ?></span>

                                                        <br>

                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $product_data["price"]; ?>.00</span>

                                                        <br>

                                                        <span class="fw-bold text-black-50 fs-5">Quantity :</span>
                                                        <input type="number" min="0" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo  $product_data["qty"]; ?>">

                                                        <br> <br>

                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $ship ?>.00</span>


                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                        <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                                        <a class="btn btn-outline-danger" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold text-black-50 fs-5">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>

                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold text-black-50 fs-5">Rs. <?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <!-- have product -->

                                    <?php
                                }
                                    ?>






                                <?php
                            }

                                ?>



                                <!-- <div class="col-12">
                            <hr class="hr-break-1">
                        </div> -->

                                <div class="col-12 col-lg-3">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fs-3 fw-bold">Summary</label>
                                        </div>

                                        <div class="col-12">
                                            <hr />
                                        </div>

                                        <div class="col-6 mb-3">
                                            <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                        </div>

                                        <div class="col-6 text-end mb-3">
                                            <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                        </div>

                                        <div class="col-6">
                                            <span class="fs-6 fw-bold">Shipping</span>
                                        </div>

                                        <div class="col-6 text-end">
                                            <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <hr />
                                        </div>

                                        <div class="col-6 mt-2">
                                            <span class="fs-4 fw-bold">Total</span>
                                        </div>

                                        <div class="col-6 mt-2 text-end">
                                            <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping; ?> .00</span>
                                        </div>

                                        <div class="col-12 mt-3 mb-3 d-grid">
                                            <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                        </div>

                                    </div>
                                </div>

                                    </div>
                                </div>




                    </div>

                </div>

            <?php
            } else {
                echo "Pleease Sign In first";
            }

            ?>
            <div class="col-12 g-0 ">

                <?php require "footer.php"; ?>
            </div>
        </div>
    </div>


    <script src="script.js"></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

    <!-- <script src="bootstrap.bundle.js"></script> -->
    <!-- <script src="bootstrap.js"></script> -->
</body>

</html>