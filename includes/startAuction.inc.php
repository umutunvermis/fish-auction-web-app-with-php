<?php
    
    require 'dbh.inc.php';
    require 'functions.inc.php';

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

    $_SESSION["auctionFlag"] = 1; // started
    $a = $_SESSION["auctionFlag"];  
    header("location: ../rename.php");

