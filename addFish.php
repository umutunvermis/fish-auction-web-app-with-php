   
    <?php
        include_once 'header.php';
        if(!isset($_SESSION["username"])){
            header("Location: login.php");
        }
    ?>

    <div id="fishForm" align="center"><br>
        <h1>Add a fish for auction</h1>
        <form action="includes/addFish.inc.php" method="post">
            <input type="text" style="width: 13% ;" name="species" placeholder="Species" required><br><br>
            <input type="text" style="width: 7.7% ;" name="weight" placeholder="Weight" required>
            <select name="unit" id="">
                <option value="kg">kilogram</option>
                <option value="g">gram</option>
            </select><br><br>
            <input type="text" style="width: 11.6% ;" name="basePrice" placeholder="Base price" required>
            <a> TL<a><br><br>
            <input type="text" style="width: 13% ;" name="boatNo"  placeholder="Boat Number" required><br><br>
            <button type="submit" name="submit">Add</button><br><br><hr>
        </form>
    </div>

    <div id="message" align="center">
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "none"){
                    echo "<p>-Fish added!-</p>";
                }
                if($_GET["error"] == "formError"){
                    echo "<p>There is something wrong</p>";
                }
                if($_GET["error"] == "invalidBoatNo"){
                    echo "<p>Boat number is not registered</p>";
                }
            }
        ?>
    </div>
    
    
    <?php if ($_SESSION["auctionFlag"] == 0)?>
        <div id="startAuction" align="center">
            <h1>Start Auction</h1><br>
            <form action="includes/startAuction.inc.php" id="startAuction" method="post">
                <label for="streamLink">Please enter youtube key of your stream.</label><br>
                <label for="streamLink">Example: https://www.youtube.com/watch?v=<span style="color: red">5qap5aO4i9A</span></label><br><br>
                <input type="text" name="streamLink" placeholder="5qap5aO4i9A" required>
                <button type="submit" name="submit">Start Auction</button>
            </form>
        </div>
    <?php } ?>


    <?php
        include_once 'footer.html';
    ?>