<?php

$serverName = "localhost";
$DBusererName = "root";
$DBpassword = "";
$DBname = "auction_project";

$conn = mysqli_connect($serverName, $DBusererName, $DBpassword, $DBname);

if(!$conn){
    die("Connection error: " . mysqli_connect_error());
}

?>