<?php
    include "dbh.inc.php";
    include "functions.inc.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
    } else {
        header("Location: ../basket.php?error=paymentFail");
    }


    buyFish($conn, $id);
    header("Location: ../basket.php?error=none");