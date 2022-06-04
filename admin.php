<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }
?>
    


<div id = mainDiv align="center"  style="margin: 50px">

    <div id = "Stock">
        <h1>Stock</h1>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Species</th>
                    <th>| Weight</th>
                    <th>| Base Price</th>
                    <th>| Boat Number</th>
                    <th>| Status</th>
                </tr>
            </thead>
            
        <?php

            $sql = "SELECT * FROM fish WHERE status != 'sold' AND status != 'paid';";
            $result = mysqli_query($conn, $sql);
            $resulCheck = mysqli_num_rows($result);

            if ($resulCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $ref = "includes/deleteFish.inc.php?id=" . $row['ID'];
                    echo 
                    "<tr>
                        <td>" . $row["species"] . "</td>
                        <td> | " . $row["weight"] . "</td>
                        <td> | " . $row["basePrice"] . "</td>
                        <td> | " . $row["boatID"] . " </td>
                        <td> | " . $row["status"] . " | </td>
                        <td>  <a class='btn btn-primary btn-sm' href=$ref>Delete</a></td>
                    </tr>";
                }
            }
        ?>
        </table>

        <br>
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "none"){
                    echo "<p>Successfully deleted!</p>";
                }
                if($_GET["error"] == "paymentFail"){
                    echo "<p>Failed!</p>";
                }
            }
        ?>

        <a class='btn btn-primary btn-sm' href="addFish.php">Start Auction</a><br><br><br>
    </div>

    <div class="sales">

    </div>
    <div id = "Stock">
        <h1>Sales</h1>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Species</th>
                    <th>| Weight</th>
                    <th>| finalPrice</th>
                    <th>| Buyer</th>
                    <th>| Fisherman</th>
                    <th>| Status</th>
                </tr>
            </thead>
            
        <?php

            $sql = "SELECT * FROM fish WHERE status = 'sold' OR status = 'paid';";
            $result = mysqli_query($conn, $sql);
            $resulCheck = mysqli_num_rows($result);

            if ($resulCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $buyerID = $row["buyerID"];
                    $boatID = $row["boatID"];

                    // Buyer name
                    $sql = "SELECT * FROM users WHERE ID = $buyerID;";     
                    $result1 = mysqli_query($conn, $sql);
                    $row1 = mysqli_fetch_assoc($result1);
                    $buyerName = $row1['name'];

                    // Fisherman name
                    $sql = "SELECT * FROM fishermen WHERE boatNo = $boatID;";
                    $result2 = mysqli_query($conn, $sql);
                    $row2 = mysqli_fetch_assoc($result2);
                    $fisherman = $row2['name'];

                    $ref = "includes/deleteFish.inc.php?id=" . $row['ID'];
                    echo 
                    "<tr>
                        <td>" . $row["species"] . "</td>
                        <td> | " . $row["weight"] . "</td>
                        <td> | " . $row["currentBid"] . "</td>
                        <td> | " . $buyerName . "</td>
                        <td> | " . $fisherman . " </td>
                        <td> | " . $row["status"] . " | </td>
                        <td>  <a style:'display=none;' class='btn btn-primary btn-sm' href=$ref>Delete</a></td>
                    </tr>";
                }
            }
        ?>
        </table>
    </div>
    <br>
    
<?php
    include_once 'footer.html';
?>