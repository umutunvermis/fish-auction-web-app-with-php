    <?php
        include_once 'header.php';
        if(!isset($_SESSION["username"])){
            header("Location: login.php");
        }
    ?>

    <div align="center">
    <h1>Register Fisherman</h1>
        <form action="includes/addFisherman.inc.php" method="post">
            <input type="text" name="name" placeholder="Full name" required><br><br>
            <input type="text" name="email" placeholder="Email" required><br><br>
            <input type="text" name="phoneNum"  placeholder="Phone Number" required><br><br>
            <input type="text" name="boatNo"  placeholder="Boat Number" required><br><br>
            <input type="text" name="address" placeholder="Address" required><br><br>
            <button type="submit" name="submit">Register</button>
        </form>
    </div>

    <div id="message" align="center">
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "none"){
                    echo "<p>-Fisherman registered!-</p>";
                }
                if($_GET["error"] == "formError"){
                    echo "<p>There is something wrong</p>";
                }
            }
        ?>
    </div>
    
    <div>
        <a href=""></a>
    </div>

    <?php
        include_once 'footer.html';
    ?>