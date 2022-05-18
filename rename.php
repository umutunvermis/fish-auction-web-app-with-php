
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
    <iframe width="640" height="360" src="https://www.youtube.com/embed/5qap5aO4i9A?autoplay=1&mute=1"
            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay;
            clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    </iframe>


        <H1>Current highest bid</H1>
        <div id="currInfo">
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
                }
                else {
                    header("Location: ../rename.php?error=stmtError");
                }

                echo"<p id=species>$species</p>";
                echo"<p id=weight>$weight</p>";
                echo"<p id=bid>$bid</p>";

            ?>
        </div>

        <div id="remainTime">
            <?php
                displayTimer($conn);
            ?>
        </div>

        <?php
        if ($_SESSION["username"] != "admin") {
        ?>
            <form action="includes/bid.inc.php" method="post">
                <input type="number" name="bid" placeholder="num" min="1">
                <button type="submit" name="submit">Bid</button>    
            </form>

        <?php
        }
        ?>
    </div>

    <?php
        include_once 'footer.html';
    ?>