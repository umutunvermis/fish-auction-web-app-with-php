<?php
    include_once 'header.php';
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }
?>

<div style="background-color:#f1f1f1; color:black; margin:50px;" align="center">

<?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "auctionNotStarted"){
                echo "<h1>Auction is not live!</h1>";
            }
        } else {
            echo "<h2>Welcome.</h2>";
        }
        ?>
</div>

<?php
    include_once 'footer.html';
?>