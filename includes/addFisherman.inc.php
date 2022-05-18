<?php
    
    if(isset($_POST["submit"])){

        $name =  $_POST["name"];
        $email = $_POST["email"];
        $phoneNum = $_POST["phoneNum"];
        $boatNo = $_POST["boatNo"];
        $address = $_POST["address"];

        require 'dbh.inc.php';
        require 'functions.inc.php';


        addFisherman($conn, $name, $email, $phoneNum, $boatNo, $address);
    } 
    else {
        header("location: ../addFish.php?error=formError");
    }
