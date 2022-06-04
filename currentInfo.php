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

        echo "<H1>Current highest bid</H1>";

        echo"<h3 id=species>$species</h3>";
        echo"<h4 id=weight>Weight: $weight</h4>";
        echo"<h4 id=bid>Current bid: $bid</h4>";
        echo"<h4 id=bid>Base price: $basePrice</h4>";
    }
    else if (mysqli_num_rows($result) == 0) {
        echo"<h1>Auction is over!</h1>";
    }

?>