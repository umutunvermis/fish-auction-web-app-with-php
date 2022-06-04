<?php

    require 'dbh.inc.php';
    require 'functions.inc.php';

    $sql = "SELECT * FROM fish WHERE status='on sale' LIMIT 1";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $buyerID = $row['buyerID'];
    } else {
        header("Location: index.php?error=acutionNotLive");
    }

    if ($buyerID > 0){

        $sql = "UPDATE fish SET status = 'sold' WHERE status = 'on sale' LIMIT 1;";

        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        } else {
            header("Location: index.php?error=auctionNotStarted");
        }
        
        $finalPrice = $row['currentBid'];

        $sql = "UPDATE fish SET finalPrice = $finalPrice WHERE status = 'sold' LIMIT 1;";

        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        } else {
            header("Location: index.php?error=auctionNotStarted");
        }

    }else {
        $sql = "UPDATE fish SET status = 'no offer' WHERE status = 'on sale' LIMIT 1;";

        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        } else {
            header("Location: index.php?error=auctionNotStarted");
        }
    }  

    $streamLink = $_POST["streamLink"];

    $dir = getcwd(); 
    $file = fopen($dir."/streamLink.txt", "w+");  
    fwrite($file,$streamLink);
    fclose($file);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

    $sql = "UPDATE fish SET status = 'on sale' WHERE status = 'not sold' LIMIT 1;";

    if (!mysqli_query($conn, $sql)) {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $minutes_to_add = 2;

    $time = new DateTime();
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

    $stamp = $time->format('Y-m-d H:i:s');

    $sql = "UPDATE fish SET sellDate = '$stamp' WHERE status = 'on sale' LIMIT 1;";
    
    if (!mysqli_query($conn, $sql)) {
        echo "Error updating record: " . mysqli_error($conn);
    }
      
    mysqli_close($conn);
    header("location: ../rename.php");