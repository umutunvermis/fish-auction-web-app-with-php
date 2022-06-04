<?php
    include_once 'header.php';
?>

    <div style="background-color:#f1f1f1; color:black" align="center">
        <h2 style="color:#D97662">Sign Up</h2>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full name" required><br><br>
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="text" name="email" placeholder="Email" required><br><br>
            <input type="text" name="phoneNum"  placeholder="Phone Number" required><br><br>
            <input type="password" name="password" placeholder="Pasword" required><br><br>
            <input type="password" name="repassword" placeholder="Repeat password" required><br><br>
            <input type="text" name="address" placeholder="Address" required><br><br>
            <button type="submit" name="submit">Sign Up</button>
        </form>        
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "invalidphone"){
                    echo "<p>Phone number is invaild!</p>";
                    echo "<p>Phone number must be a 10 digit number</p>";
                }
                if($_GET["error"] == "invalidpsw"){
                    echo "<p>Password is invalid!</p>";
                    echo "<p>A password must cointain at least a number, </p>";
                    echo "<p>an upper case letter, and a lower case letter.</p>";
                    echo "<p>And it must be longer than 8 charracters!</p>";
                }
                if($_GET["error"] == "invalidusername"){
                    echo "<p>Username is invalid!</p>";
                }
                if($_GET["error"] == "invalidemail"){
                    echo "<p>Email is invalid!</p>";
                }
                if($_GET["error"] == "usernameexists"){
                    echo "<p>Username exists!</p>";
                }            
                if($_GET["error"] == "emailexists"){
                    echo "<p>Email exists!</p>";
                }
                if($_GET["error"] == "passwordmissmatch"){
                    echo "<p>Passwords does not match!</p>";
                }
                if($_GET["error"] == "passwordisshort"){
                    echo "<p>Password must be longer than 6 digits!</p>";
                } 
            }
        ?>
    </div>


<?php
    include_once 'footer.html';
?>