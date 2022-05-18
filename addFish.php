   
    <?php
        include_once 'header.php';
        if(!isset($_SESSION["username"])){
            header("Location: login.php");
        }
    ?>

    <div id="fishForm" align="center"><br>
        <h1>Add a fish for auction</h1>
        <form action="includes/addFish.inc.php" method="post">
            <input type="text" style="width: 12% ;" name="species" placeholder="Species" required><br><br>
            <input type="text" style="width: 7.7% ;" name="weight" placeholder="Weight" required>
            <select name="unit" id="">
                <option value="kg">kilogram</option>
                <option value="g">gram</option>
            </select><br><br>
            <input type="text" style="width: 10.8% ;" name="basePrice" placeholder="Base price" required>
            <a> TL<a><br><br>
            <input type="text" style="width: 12% ;" name="boatNo"  placeholder="Boat Number" required><br><br>
            <button type="submit" name="submit">Next Fish</button><br><br><hr>
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
    <?php if ($_SESSION["auctionFlag"] != 1) { ?>
        <div id="startAuction" align="center">
            <form action="includes/startAuction.inc.php" id="startAuction" method="post">
                <button type="submit" name="submit">Start Auction</button>
            </form>
        </div>
    <?php }
    else { 
        include_once "rename.php";
    ?>
        <div id="nextAuction" align="center">
            <form action="includes/nextAuction.inc.php" id="startAuction" method="post">
                <button type="submit" name="submit">Next Auction</button>
            </form>
        </div>
    <?php } ?>

    <?php
        include_once 'footer.html';
    ?>