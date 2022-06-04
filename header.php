<?php
    session_start();
?>

<html>
    <head>
        <title>Auction Project</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="css/header.css">
        <style>
            body {
                font-family:verdana;
            }
        </style>
    </head>

    <body style="background-color:#F7F7F7">

        <nav>
            <div class="topnav" style="background-color:#F9ECE0" align="left";>    
            <a href="index.php"><img src="images/icon.jpg" alt="Logo" style="height:100px"></a><br>
                <ul style="list-style-type:none;" align="left";>
                    <?php
                        if(!isset($_SESSION["username"])){
                            echo "<a href='login.php'>Login<a>";
                            echo "<a href='signup.php'>Sign Up<a>";
                        }
                        else if($_SESSION["username"] == "admin"){
                            echo "<a href='admin.php'>Database<a>";
                            echo "<a href='addFish.php'>Add Fish<a>";
                            echo "<a href='addFisherman.php'>Register Fisherman<a>";
                            echo "<a id=logout href=#>Log Out<a>";
                        }   
                        else {
                            echo "<a href='rename.php'>Auction<a>";
                            echo "<a href='basket.php'>Basket<a>";
                            echo "<a href='includes/logout.inc.php'>Log Out<a>";
                        }
                    ?>
                    <script>
                        document.getElementById("logout")
                        .addEventListener("click", function( e ){ 
                            if( ! confirm("Are you sure?") ){
                                e.preventDefault(); 
                            } else {
                                window.location.href = 'includes/logout.inc.php';
                            }
                            });
                     </script>
            </div>
            <hr>
        </nav>
        <div id="mainBody">
