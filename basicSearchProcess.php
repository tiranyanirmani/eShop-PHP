<?php

require "connection.php";

$search_txt = $_POST["t"];
$search_select = $_POST["s"];

$query = "SELECT * FROM `product` ";

if (!empty($search_txt) && $search_select == 0) {

    $query .= "WHERE `title` LIKE '%" . $search_txt . "%'";
} elseif (empty($search_txt) && $search_select != 0) {

    $query .= "WHERE `category_id` = '" . $search_select . "'";
} elseif (!empty($search_txt) && $search_select != 0) {

    $query .= "WHERE `title` LIKE '%" . $search_txt . "%' AND `category_id` = '" . $search_select . "'";
}

?>


<div class="row">

    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php

            if ($_POST["page"] != 0) {

                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $result_per_page = 6;
            $number_of_page = ceil($product_num / $result_per_page);

            $viewed_results = ((int)$pageno - 1) * $result_per_page;
            $query .= " LIMIT " . $result_per_page . " OFFSET " . $viewed_results;
            $result_rs = Database::search($query);
            $result_num = $result_rs->num_rows;

            while ($product_data = $result_rs->fetch_assoc()) {

            ?>

                <div class="card mb-3 mt-3 col-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-4 mt-4">

                            <?php

                            $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` ='" . $product_data["id"] . "'");
                            $product_img_data = $product_img_rs->fetch_assoc();

                            ?>

                            <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">

                                <h5 class="card-title fw-bold"><?php echo $product_data["title"]; ?></h5>
                                <span class="card-text text-primary fw-bold"><?php echo $product_data["price"]; ?></span>
                                <br />
                                <span class="card-text text-success fw-bold fs"><?php echo $product_data["qty"]; ?> Items Left</span>

                                <div class="row">
                                    <div class="col-12">

                                        <div class="row g-1">
                                            <div class="col-12 col-lg-6 d-grid">
                                                <a href="#" class="btn btn-success fs">By Now</a>
                                            </div>
                                            <div class="col-12 col-lg-6 d-grid">
                                                <a href="#" class="btn btn-danger fs">Add Cart</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php

            }

            ?>

        </div>
    </div>

</div>

<div class="col-12 text-center">

    <div class="pagination">


        <a <?php
            if ($pageno <= 1) {

                echo "href=#";
            } else {

            ?> onclick="basicSearch('<?php echo ($pageno - 1); ?>');" <?php

                                                                    }
                                                                        ?>>&laquo;</a>

        <?php

        for ($page = 1; $page <= $number_of_page; $page++) {

            if ($page == $pageno) {

        ?>

                <a onclick="basicSearch('<?php echo ($page); ?>');" class="active"><?php echo $page; ?></a>

            <?php

            } else {
            ?>

                <a onclick="basicSearch('<?php echo ($page); ?>');"><?php echo $page; ?></a>

        <?php
            }
        }

        ?>
        <a <?php
            if ($pageno >= $number_of_page) {

                echo "href=#";
            } else {

            ?> onclick="basicSearch('<?php echo ($pageno + 1); ?>');" <?php

                                                                    }
                                                                        ?>>&raquo;</a>
    </div>

</div>