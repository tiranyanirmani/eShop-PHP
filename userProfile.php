<!DOCTYPE html>



<html>

<head>
    <title>eShop | User Profile</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="bg-primary">

    <div class="container-fluid">
        <div class="row g-2">

            <?php require "header.php"; ?>

            <?php

            // session_start();

            require "connection.php";

            if (isset($_SESSION["u"]["email"])) {

                $email = $_SESSION["u"]["email"];

                $resultset = Database::search("SELECT * FROM users INNER JOIN `profile_image` ON users.email=profile_image.users_email INNER JOIN user_has_address ON user_has_address.users_email=users.email
                INNER JOIN city ON city.id=user_has_address.city_id INNER JOIN district ON district.id=city.district_id INNER JOIN province ON province.id=district.province_id
                INNER JOIN gender ON gender.id=users.gender_id
                WHERE users.email = 'thinuka1@gmail.com'");

                $n = $resultset->num_rows;

                $d = $resultset->fetch_assoc();

            ?>

                <div class="col-12 bg-body rounded mt-4 mb-4">
                    <div class="row">

                        <div class="col-md-3 border-end">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                <?php

                                if ($d["path"] == null) {

                                ?>

                                    <img id="viewImage" src="resources\profile_img\629a239e07add.svg" class="rounded mt-5" style="width: 150px;">

                                <?php

                                } else {

                                ?>

                                    <img id="viewImage" src="<?php echo $d["path"]; ?>" class="rounded mt-5" style="width: 150px;">

                                <?php
                                }

                                ?>


                                <span class="fw-bold"><?php echo $d["fname"] . " " . $d["lname"]; ?></span>
                                <span class="text-black-50"><?php echo $d["email"]; ?></span>
                                <input class="d-none" type="file" accept="$img/*" id="profileimg">
                                <label class="btn btn-primary mt-5" for="profileimg" onclick="changeImage();">Update Profile Image</label>

                            </div>
                        </div>

                        <div class="col-md-5 border-end">
                            <div class="p-3 py-5 ">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="fw-bold">Profile Setting</h4>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="fn" value="<?php echo $d["fname"]; ?>">
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="ln" value="<?php echo $d["lname"]; ?>">
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Mobile</label>
                                        <input type="text" class="form-control" id="mo" value="<?php echo $d["mobile"]; ?>">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" aria-describedby="viewpassword" id="pwtxt" value=" <?php echo $d["password"]; ?>" readonly>
                                            <button class="btn btn-outline-primary" id="viewpassword" onclick="viewpassword();"><i class="bi bi-eye-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="<?php echo $d["email"]; ?>" readonly>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Registered Date</label>
                                        <input type="text" class="form-control" value="<?php echo $d["joined_date"]; ?>" readonly>
                                    </div>

                                    <?php

                                    if (!empty($d["line_1"])) {

                                    ?>

                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">Address Line 01</label>
                                            <input type="text" class="form-control" id="ln_1" value=" <?php echo $d['line_1']; ?>">
                                        </div>

                                    <?php

                                    } else {
                                    ?>

                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">Address Line 01</label>
                                            <input type="text" class="form-control" id="ln_1" placeholder="Address Line 01">
                                        </div>

                                    <?php
                                    }

                                    if (!empty($d["line_2"])) {

                                    ?>

                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">Address Line 02</label>
                                            <input type="text" class="form-control" id="ln_2" value="<?php echo $d["line_2"]; ?>">
                                        </div>
                                    <?php

                                    } else {
                                    ?>

                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">Address Line 02</label>
                                            <input type="text" class="form-control" id="ln_2" placeholder="Address Line 02">
                                        </div>

                                    <?php
                                    }
                                    ?>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="pr">
                                            <option value="0">Select Province</option>
                                            <?php

                                            $provincers = Database::search("SELECT * FROM `province`");
                                            $pn = $provincers->num_rows;

                                            for ($x = 0; $x < $pn; $x++) {

                                                $pd = $provincers->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $pd["id"]; ?>" <?php
                                                                                            if ($pd["id"] == $d["province_id"]) {
                                                                                            ?> selected <?php
                                                                                                    }
                                                                                                        ?>><?php echo $pd["name"]; ?>&nbsp;Province</option>

                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="dr">
                                            <option value="0">Select District</option>

                                            <?php

                                            $districtrs = Database::search("SELECT * FROM `district`");
                                            $dn = $districtrs->num_rows;

                                            for ($x = 0; $x < $dn; $x++) {

                                                $dd = $districtrs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $dd["id"]; ?>" <?php
                                                                                            if ($dd["id"] == $d["district_id"]) {
                                                                                            ?> selected <?php
                                                                                                    }
                                                                                                        ?>><?php echo $dd["name"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">City</label>
                                        <select class="form-select" id="ci">
                                            <option value="0">Select City</option>
                                            <?php

                                            $cityrs = Database::search("SELECT * FROM `city`");
                                            $cn = $cityrs->num_rows;

                                            for ($x = 0; $x < $cn; $x++) {

                                                $cd = $cityrs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $cd["id"]; ?>" <?php
                                                                                            if ($cd["id"] == $d["city_id"]) {
                                                                                            ?> selected <?php
                                                                                                    }
                                                                                                        ?>><?php echo $cd["name"]; ?></option>

                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <?php

                                    if (!empty($d["postal_code"])) {

                                    ?>

                                        <div class="col-md-6 mt-3">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" id="pc" value="<?php echo $d["postal_code"]; ?>">
                                        </div>

                                    <?php

                                    } else {
                                    ?>

                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" placeholder="Postal Code">
                                        </div>

                                    <?php
                                    }

                                    ?>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Gender</label>
                                        <input type="text" class="form-control" value="<?php echo $d["gender_name"]; ?>" readonly>
                                    </div>


                                    <div class="col-md-12 d-grid mt-5 mb-3">
                                        <button class="btn btn-primary" onclick="update_profile();">Update My Profile</button>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<?php

            } else {

?>

    <script>
        window.location = "index.php";
    </script>

<?php

            }

?>