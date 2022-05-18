<?php
    include_once 'header.php';
?>
    <div style="background-color:#f1f1f1; color:black" align="center">
        <h2 style="color:#D97662">Login</h2>
        <form action="includes/login.inc.php" method="post">
            <div class="container">
                <input type="text" placeholder="Username" name="uname" required>
                <br><br>
                <input type="password" placeholder="Password" name="psw" required>
                <br><br>
                <button type="submit" name="submit">Login</button>    
            </div>
        </form>
        <span class="psw">Do not have an account? <a href="signup.php">Sign up</a></span>
        
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "none"){
                echo "<p>-Signed up!-</p>";
            }
            if($_GET["error"] == "wrong"){
                echo "<p>Username or password is wrong!</p>";
            }
        }
        ?>
    </div>
    

<?php
    include_once 'footer.html';
?>
