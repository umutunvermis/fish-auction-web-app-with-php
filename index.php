<?php
    include_once 'header.php';
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }
?>

<div style="background-color:#f1f1f1; color:black" align="center">

    <h2>Hello <?php echo $_SESSION["name"];?>



</div>

<?php
    include_once 'footer.html';
?>