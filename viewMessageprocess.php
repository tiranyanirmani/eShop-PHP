<?php

session_start();
require "connection.php";

$recivers_email = $_SESSION["u"]["email"];
$senders_email = $_GET["email"];

$message_rs = Database::search("SELECT * FROM `message` WHERE `from`='" . $senders_email . "' OR `to`='" . $senders_email . "'");

$message_num = $message_rs->num_rows;

for ($i = 0; $i < $message_num; $i++) {

    $message_data = $message_rs->fetch_assoc();

    if ($message_data["from"] == $senders_email & $message_data["to"] == $recivers_email) {

?>

        <!-- reciver's message -->

        <div class="mb-3 w-50">

            <img src="resources/profile_img/user_icon.svg" style="width:50px;" class="rounded-circle mb-1" />

            <div>
                <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-dark"><?php echo $message_data["content"]?></p>
                </div>
                <p class="small text-black-50 text-end">01:10 | 10.05.2022</p>
                <p class="invisible" id="rmail">xxxxxxxxx</p>
            </div>

        </div>

        <!-- reciver's message -->

    <?php

    } elseif ($message_data["from"] == $recivers_email & $message_data["to"] == $senders_email) {

    ?>

        <!-- sender's message -->

        <div class="mb-3 w-50">
            <div>
                <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-white"><?php echo $message_data["content"]?></p>
                </div>
                <p class="small text-black-50 text-end">01:10 | 10.05.2022</p>
            </div>
        </div>

        <!-- sender's message -->

<?php

    }

    Database::iud("UPDATE `message` SET `status`='1' WHERE `from`='".$senders_email."' OR `to`='".$senders_email."'");
}
