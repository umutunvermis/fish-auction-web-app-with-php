<?php
    include_once 'header.php';
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }
?>

<link rel="stylesheet" href="css/admin.css">

<div id = mainDiv>
    <a id=addFishLogo href="addFish.php">add Fish</a>
</div>

<?php
    include_once 'footer.html';
?>