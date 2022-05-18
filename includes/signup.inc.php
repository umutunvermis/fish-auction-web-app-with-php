<?php

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $phoneNum = $_POST["phoneNum"];
    $address = $_POST["address"];

    require 'dbh.inc.php';
    require 'functions.inc.php';

    
    if(isPasswordValid($password) != false){
        header("location: ../signup.php?error=invalidpsw");
        exit();
    }
    
    if(isPhoneNumValid($phoneNum) != false){
        header("location: ../signup.php?error=invalidphone");
        exit();
    }

    if(isUsernameValid($username) != false){
        header("location: ../signup.php?error=invalidusername");
        exit();
    }
    if(isemailValid($email) != false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(isUsernameUnique($username,$conn) != false){
        header("location: ../signup.php?error=usernameexists");
        exit();
    }
    if(isEmailUnique($email,$conn) != false){
        header("location: ../signup.php?error=emailexists");
        exit();
    }
    if(isPasswordsMatch($password,$repassword) != false){
        header("location: ../signup.php?error=passwordmissmatch");
        exit();
    }
    if(strlen($password)<6){
        header("location: ../signup.php?error=passwordisshort");
        exit();
    }
    
    createUser($conn, $name, $email, $username, $phoneNum, $address, $password);
}   
else{
    header("location: ../signup.php");
    exit();
}

