<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="col-12 col-lg-3 offset-lg-1 align-self-start">

                <span class="text-lg-start label1"><b>Welcome</b>


                    <?php
                    session_start();
                    if (isset($_SESSION["u"])) {
                        $data = $_SESSION["u"];
                    ?>


                        <?php echo $data["fname"]; ?>

                </span> |

                <span class="text-lg-start label2" onclick="signOut();">Sign Out</span> |

            <?php
                    } else {

            ?>
                <a href="index.php">Sign In or Register</a>
            <?php

                    }

            ?>

            <span class="text-lg-start label2">Help and Contact</span>

            </div>

            <div class="col-12 col-lg-3 offset-lg-5 align-self-end" style="text-align: center;">

                <div class="row">

                    <div class="col-1 col-lg-3 mt-2">
                        <span class="text-start label2">Sell</span>
                    </div>

                    <div class="col-2 col-lg-6 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My eShop
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="home.php">Home</a></li>
                            <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Sellings</a></li>
                            <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                            <li><a class="dropdown-item" href="watchlist.php">Wish List</a></li>
                            <li><a class="dropdown-item" href="#">Purchase History</a></li>
                            <li><a class="dropdown-item" href="message.php">Messages</a></li>
                            <li><a class="dropdown-item" href="#">Saved</a></li>
                        </ul>
                    </div>

                    <!-- <div class="col-1">
                        <span onclick="cart();" class="text-start label2"><i class="bi bi-cart2 fs-3"></i></span>
                    </div> -->

                    <div class="px-5 px-lg-0 col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon" onclick="cart();"></div>

                </div>
            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>

</body>

</html>