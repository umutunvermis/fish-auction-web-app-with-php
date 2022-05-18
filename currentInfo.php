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
