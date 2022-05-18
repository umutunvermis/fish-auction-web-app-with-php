<?php
    
    if(isset($_POST["submit"])){

        $species =  $_POST["species"];
        $weight = $_POST["weight"]." ".$_POST["unit"];
        $basePrice = $_POST["basePrice"];
        $finalPrice = "undefined";
        $status = "not sold";
        $sellDate = "undefined";
        $boatNo = $_POST["boatNo"];

        require 'dbh.inc.php';
        require 'functions.inc.php';


        if(isBoatNotRegistered($boatNo, $conn) == false){   
            header("location: ../addFish.php?error=invalidBoatNo");
            exit();
        }


        addFish($conn, $species, $weight, $basePrice, $finalPrice, $status, $sellDate);




    } 
    else {
        header("location: ../addFish.php?error=formError");
    }


?>