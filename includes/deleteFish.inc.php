<?php
    include "dbh.inc.php";
    include "functions.inc.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
    } else {
        header("Location: ../adimn.php?error=paymentFail");
    }


    deleteFish($conn, $id);
    header("Location: ../admin.php?error=none");