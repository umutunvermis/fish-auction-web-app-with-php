<?php

if(isset($_POST["submit"])){

    $username = $_POST["uname"];
    $password = $_POST["psw"];

    require 'dbh.inc.php';
    require 'functions.inc.php';

    loginUser($conn, $username, $password);
    
}
else{
    header("location: ../login.php");
}

