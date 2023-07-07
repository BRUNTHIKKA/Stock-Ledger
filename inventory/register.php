<?php

if(empty($_POST["regFirstName"])){
    die("FirstName is required");
}

if(empty($_POST["regLastName"])){
    die("LastName is required");
}

if( ! filter_var($_POST["regEmail"], FILTER_VALIDATE_EMAIL)){
    die("Valied regEmailEmail is required");
}

if(strlen($_POST["regPassword"]) < 8){
    die("Password must be at least 8 characters");
}

if(! preg_match("/[a-z]/i", $_POST["regPassword"])){
    die("Password must contain at least one letter");
}

if(! preg_match("/[0-9]/i", $_POST["regPassword"])){
    die("Password must contain at least one number");
}

if($_POST["regPassword"] !== $_POST["regConfirmPassword"]){
    die("Password must match");
}
$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user(regFirstName, regLastName, regEmail, regPassword)
        VALUES (?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if( ! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["regFirstName"],
                  $_POST["regLastName"],
                  $_POST["regEmail"],
                  $_POST["regPassword"]);

if($stmt->execute()){
    header("Location: register_success.html");
    exit;
} else{
    if($mysqli->errno === 1062){
        die("regEmail already taken");
    } else{
        die($mysqli->error . "" . $mysqli->errno);
    }
}



print_r($_POST);
var_dump($regPassword_hash);

?>