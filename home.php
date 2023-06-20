<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>eShop | Home</title>

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

            ?>

            <hr class="hr-break-1" />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">

                    <div class="col-4 col-lg-1 offset-4 offset-lg-1 logo-img"></div>

                    <div class="col-8 col-lg-6">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_text" />

                            <select class="btn btn-outline-primary" id="basic_search_select">
                                <option value="0" readonly>Select Category</option>

                                <?php

                                $categoryrs = Database::search("SELECT * FROM `category`");
                                $num = $categoryrs->num_rows;

                                for ($x = 0; $x < $num; $x++) {

                                    $cd = $categoryrs->fetch_assoc();
                                ?>

                                    <option value="<?php echo $cd["id"]; ?>"><?php echo $cd["name"]; ?></option>


                                <?php
                                }

                                ?>

                            </select>

                        </div>
                    </div>

                    <div class="col-2 d-grid gap-2">
                        <button class="btn btn-primary mt-3 search-btn" onclick="basicSearch(0);">Search</button>
                    </div>

                    <div class="col-2 mt-4">
                        <a href="advancedSearch.php" class="link-secondary link1">Advanced</a>
                    </div>

                </div>
            </div>

            <hr class="hr-break-1" />

            <div class="col-12" id="basicSearchResult">

                <div class="col-12 d-none d-lg-block">
                    <div class="row">
                        <div id="carouselExampleCaptions" class="col-8 offset-2 carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="resources/slider images/posterimg.jpg" class="d-block poster-img-1">
                                    <div class="carousel-caption d-none d-md-block poster-caption">
                                        <h5 class="poster-title">Welcome to eShop</h5>
                                        <p class="poster-text">The World's Best Online Store By One Click.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/slider images/posterimg2.jpg" class="d-block poster-img-1">
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/slider images/posterimg3.jpg" class="d-block poster-img-1">
                                    <div class="carousel-caption d-none d-md-block poster-caption-1">
                                        <h5 class="poster-title">Be Free...</h5>
                                        <p class="poster-text">Experience the Lowest Delivery Costs With Us.</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <?php

                $categoryrs = Database::search("SELECT * FROM `category`");
                $num = $categoryrs->num_rows;

                for ($y = 0; $y < $num; $y++) {
                    $d = $categoryrs->fetch_assoc();

                ?>

                    <div class="col-12">
                        <a href="#" class="link-dark link2"><?php echo $d["name"]; ?></a>&nbsp;&nbsp;
                        <a href="#" class="link-dark link3">See All&nbsp; &rarr;</a>
                    </div>
                    <!-- Category name -->

                    <!-- Products -->

                    <div class="col-12 mb-3">

                        <div class="row border border-primary">

                            <div class="col-12 col-lg-12">

                                <div class="row justify-content-center gap-2">

                                    <?php


                                    $productrs  = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $d["id"] . "' AND `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                    $pn = $productrs->num_rows;

                                    for ($z = 0; $z < $pn; $z++) {

                                        $pd = $productrs->fetch_assoc();

                                    ?>

                                        <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                                            <?php

                                            $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pd["id"] . "'");
                                            $image = $imagers->fetch_assoc();

                                            ?>

                                            <img src="<?php echo $image["code"]; ?>" class="card-img-top img-thumbnail" style="height: 200px;" />
                                            <div class="card-body ms-0 m-0">
                                                <h5 class="card-title"><?php echo $pd["title"]; ?> &nbsp;<span class="badge bg-info">New</span></h5>
                                                <span class="card-text text-primary">Rs.<?php echo $pd["price"]; ?>.00</span>
                                                <br />

                                                <?php

                                                if ($pd["qty"] > 0) {

                                                ?>

                                                    <span class="card-text text-warning"><b>In Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-success fw-bold"><?php echo $pd["qty"]; ?> Item Available</span>
                                                    <a href='<?php echo "singleProductView.php?id=" . ($pd["id"]) ?>' class="btn btn-success col-12">Buy Now</a>
                                                    <a onclick='addToCart(<?php echo $pd["id"]; ?>);' class="btn btn-danger col-12 mt-1">Add to Cart</a>

                                                <?php

                                                } else {

                                                ?>

                                                    <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-success fw-bold">00 Item Available</span>
                                                    <a href="#" class="btn btn-success col-12 disabled">Buy Now</a>
                                                    <a href="#" class="btn btn-danger col-12 mt-1 disabled">Add to Cart</a>





                                                <?php

                                                }

                                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE   `product_id` ='" . $pd["id"] . "' AND `users_email`='" . $_SESSION["u"]["email"] . "'");
                                                $watchlist_num = $watchlist_rs->num_rows;

                                                if ($watchlist_num == 1) {

                                                ?>

                                                    <a class="btn btn-secondary col-12 mt-1" onclick='addToWatchlist(<?php echo $pd["id"]; ?>);'>
                                                        <i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $pd["id"]; ?>"></i>
                                                    </a>

                                                <?php

                                                } else {

                                                ?>

                                                    <a class="btn btn-secondary col-12 mt-1" onclick='addToWatchlist(<?php echo $pd["id"]; ?>);'>
                                                        <i class="bi bi-heart-fill fs-5 text-white" id="heart<?php echo $pd["id"]; ?>"></i></a>

                                                <?php
                                                }

                                                ?>




                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>



                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Products -->

            </div>



        <?php
                }

        ?>

        <?php

        require "footer.php";

        ?>

        <!-- Category name -->


        </div>
    </div>

    <script src="script.js"></script>
    <!-- <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script> -->

</body>

</html>