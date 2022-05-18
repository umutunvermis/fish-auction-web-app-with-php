<?php

function isUsernameValid($username){
    $r;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $r = true;
    }
    else{
        $r = false;
    }
    return $r;
}

function isPhoneNumValid($phoneNum){
    $r;
    if ($phoneNum >= 1000000000 && $phoneNum < 10000000000){
        $r = false;
    }
    else{
        $r = true;
    }
    return $r;
}

function isemailValid($email){
    $r;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       $r = true;
    }
    else{
        $r = false;
    }
    return $r;
}

function isPasswordValid($password){
    $r;
    if( strlen($password) >= 8 && strlen($password) < 15){
        $r = false;
    }
    else {
        $r = true;
    }
    return $r;
}

function isPasswordsMatch($password,$repassword){
    $r;
    if($password !== $repassword){
        $r = true;
    }
    else{
        $r = false;
    }
    return $r;
}

function isUsernameUnique($username,$conn){
    $sql = "SELECT * FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmterror");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){    
        return $row;
    }
    else{
        $r = false;
        return $r;
    }
    mysqli_stmt_close($stmt);
}

function isEmailUnique($email, $conn){
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmterror");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(mysqli_fetch_assoc($resultData)){
        return true;
    }
    else{
        $r = false;
        return $r;
    }
    mysqli_stmt_close($stmt);
}

function isBoatNotRegistered($boatNo, $conn){
    $sql = "SELECT * FROM fishermen WHERE boatNo = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../addFish.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $boatNo);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(mysqli_fetch_assoc($resultData)){
        return true;
    }
    else{
        $r = false;
        return $r;
    }
    mysqli_stmt_close($stmt);
}   


function createUser($conn, $name, $email, $username, $phoneNum, $address, $password){
    $sql = "INSERT INTO users (name, email, username, psw, phoneNum, address) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $username, $password, $phoneNum, $address);
    mysqli_stmt_execute($stmt);
    
    //$dir = getcwd()."/user"; 
    //mkdir($dir."/".$username, 0777);
    header("location: ../login.php?error=none");
    exit();
    
}

function addFish($conn, $species, $weight, $basePrice, $finalPrice, $status, $sellDate){

    $sql = "INSERT INTO fish (species, weight, basePrice, finalPrice, status, sellDate) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../addFish.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $species, $weight, $basePrice, $finalPrice, $status, $sellDate);
    mysqli_stmt_execute($stmt);

    header("location: ../addFish.php?error=none");
}

function addFisherman($conn, $name, $email, $phoneNum, $boatNo, $address){

    $sql = "INSERT INTO fishermen (name, email, phoneNum, boatNo, address) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../addFisherman.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss",  $name, $email, $phoneNum, $boatNo, $address);
    mysqli_stmt_execute($stmt);

    header("location: ../addFisherman.php?error=none");
}

function loginUser($conn, $username, $password){
    $usernameExits = isUsernameUnique($username, $conn);

    if($usernameExits == false){
        header("location: ../login.php?error=wrong");
        exit();         
    }
    $passwordFromDB = $usernameExits["psw"];
    if($password !== $passwordFromDB){
        header("location: ../login.php?error=wrong");
        exit();
    }
    else{
        session_start();
        $_SESSION["userID"] = $usernameExits["ID"];
        $_SESSION["name"] = $usernameExits["name"];
        $_SESSION["username"] = $usernameExits["username"];
        $_SESSION["isActive"] = 0;

        if ($_SESSION["username"] == "admin") {
            $_SESSION["auctionFlag"] = 0;
            header("location: ../admin.php");
            exit();

        } else {
            header("location: ../index.php");
            exit();
        }
    }
}



function displayTimer($conn) {

    $sql = "SELECT * FROM fish WHERE status='on sale' LIMIT 1";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $sellDate = $row['sellDate'];
    }
    else {
        header("Location: ../rename.php?error=stmtError");
    }
    $currTime = new DateTime();
    $deadLine = new DateTime($sellDate);
    $stamp = $deadLine->format('Y-m-d H:i:s');  
    $diff=date_diff($currTime,$deadLine);
    $display = $diff->format('%i Minute %s Seconds');
    if ($diff->format("%r%i%s")>0) {
        echo "<p id=time>Remaining Time time: $display</p>";
    } else {
        echo "<p id=time>finished</p>  ";
    }
}


function finishSale() {
    
    $sql = "SELECT * FROM fish WHERE status='on sale' LIMIT 1";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $sellDate = $row['sellDate'];
        $currentBid = $row['currentBid'];

    }
    else {
        header("Location: ../admin.php?error=stmtError");
    }


    $sql = "UPDATE fish SET status = 'on sale' WHERE ID = '$ID';";

    if (!mysqli_query($conn, $sql)) {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>