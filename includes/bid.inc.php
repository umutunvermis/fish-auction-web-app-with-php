<?php

    require 'dbh.inc.php';
    require 'functions.inc.php';

    $bid = $_POST["bid"];

    $sql = "SELECT * FROM fish WHERE status='on sale' LIMIT 1";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $ID = $row['ID'];
        $oldBid = $row['currentBid'];
        $basePrice = $row['basePrice'];
        $sellDate = $row['sellDate'];
    }
    else {
        header("Location: ../rename.php?error=stmtError");
    }

    if((int) $bid > (int) $oldBid && (int) $bid > (int) $basePrice){

        $sql = "UPDATE fish SET currentBid = '$bid' WHERE ID = '$ID';";

        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        }

        
        $seconds_to_add = 10;

        $time = new DateTime($sellDate);
        $time->add(new DateInterval('PT' . $seconds_to_add . 'S'));
        
        $stamp = $time->format('Y-m-d H:i:s');
        echo"<a>$stamp</a>";

        $sql = "UPDATE fish SET sellDate = '$stamp' WHERE ID = '$ID';";

        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
        
        header("Location: ../rename.php?=bidAccepted");

    } 
    else {
        header("Location: ../rename.php?error=bidDenied");
    }
