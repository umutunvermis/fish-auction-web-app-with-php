
   <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous">
    </script>
    
    
    
    <script>
        $(document).ready(function() {
            setInterval(
                function() {
                $("#currFish").load("bid.inc.php");
                $("#remainTime").load("data.php");
                $("#currInfo").load("currentInfo.php");
                },1000
            );
        });
    </script>
    
    <?php
        include_once 'header.php';
        if(!isset($_SESSION["username"])){
            header("Location: login.php");
        }
    ?>


    <div id="auctionDisplay" align="center">    
        
        <?php
            $dir = getcwd()."/includes"; 
            $file = fopen($dir."/streamLink.txt", "r");  
            $streamLink = fread($file,10);
            fclose($file);
            echo "<iframe width='640' height='360' src='https://www.youtube.com/embed/5qap5aO4i9A?autoplay=1&mute=1' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        ?>
        

        
        <div id="currInfo">
            <H1>Current highest bid</H1>
            <?php

                require 'includes/dbh.inc.php';
                require 'includes/functions.inc.php';

                $sql = "SELECT * FROM fish WHERE status='on sale' LIMIT 1";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $bid = $row['currentBid'];
                    $species = $row['species'];
                    $weight = $row['weight'];
                    $basePrice = $row['basePrice'];
                }
                else if (mysqli_num_rows($result) == 0) {
                    header("Location: index.php?error=auctionNotStarted");
                }

                echo"<h3 id=species>$species</h3>";
                echo"<h4 id=weight>Weight: $weight</h4>";
                echo"<h4 id=bid>Current bid: $bid</h4>";
                echo"<h4 id=bid>Base price: $basePrice</h4>";

            ?>
        </div>

        <div id="remainTime">
            <?php
                $bidFlag = displayTimer($conn);
        
        echo "</div>";
        
        
        if ($_SESSION["username"] != "admin") {
            ?>
            <form action="includes/bid.inc.php" method="post">
                <input type="hidden" id="custId" name="userID" value=<?php echo $_SESSION['userID']?>>
                <input type="number" name="bid" placeholder="num" min="1">
                <button type="submit" name="submit">Bid</button>    
            </form>
        <?php } else { 
        if ($_SESSION["username"] == "admin") {
            ?>
            <form action="includes/nextAuction.inc.php" method="post">
                <button type="submit" name="submit">Next Fish</button>    
            </form>
            <?php
            }
        
        } ?>

        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "bidAccepted"){
                    echo "<p>-Successful-</p>";
                }
                if($_GET["error"] == "bidDenied"){
                    echo "<p>-Bid is invalid-</p>";
                }
            }
        ?>

    </div>

    <?php
        include_once 'footer.html';
    ?>