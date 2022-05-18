<?php
    session_start();
?>

<html>
    <head>
        <title>Project Name</title>
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
                            echo "<a href='admin.php'>Index<a>";
                            echo "<a href='addFish.php'>Add Fish<a>";
                            echo "<a href='addFisherman.php'>Register Fisherman<a>";
                            echo "<a id=logout href=#>Log Out<a>";
                        }
                        else {
                            echo "<a href='rename.php'>Auction<a>";
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
