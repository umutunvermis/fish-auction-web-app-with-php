<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';

    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }
?>

<link rel="stylesheet" href="css/admin.css">


<div id = mainDiv align="center" style="margin: 50px">

    <br>

    


    <?php

        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM fish WHERE buyerID = $userID AND status = 'sold';";
        $result = mysqli_query($conn, $sql);
        $resulCheck = mysqli_num_rows($result);

        if ($resulCheck > 0) {
    ?>
    <table>
        <thead>
            <tr>
                <th>Species</th>
                <th>| Weight</th>
                <th>| finalPrice</th>
                <th>| Sell Date</th>
            </tr>
        </thead>
    <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $ref = "includes/buyFish.inc.php?id=" . $row['ID'];
                echo 
                "<tr>
                    <td>" . $row["species"] . "</td>
                    <td> | " . $row["weight"] . "</td>
                    <td> | " . $row["currentBid"] . "</td>
                    <td> | " . $row["sellDate"] . " | </td>
                    <td>  <a class='btn btn-primary btn-sm' href=$ref>Pay</a></td>
                 </tr>";
            }
        } else {
            echo "<h1> Basket is empty!</h1>";
        }
    ?>
    
    </table>
    <br>

    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "none"){
                echo "<p>Payment successful!</p>";
            }
            if($_GET["error"] == "paymentFail"){
                echo "<p>Payment failed!</p>";
            }
        }
    ?>

</div>

    

<?php
    include_once 'footer.html';
?>