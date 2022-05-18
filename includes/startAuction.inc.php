<?php
    
    require 'dbh.inc.php';
    require 'functions.inc.php';

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

    /*
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) <= 0){
        header("location: ../addFish.php?error=stmterror");
        exit();
    } 
    else {
        $row = mysqli_fetch_assoc($result);
        echo  $row['species']  ;
    }
    */
    $_SESSION["auctionFlag"] = 1; // started
    header("location: ../addFish.php");

