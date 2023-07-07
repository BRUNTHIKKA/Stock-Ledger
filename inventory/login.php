<?php
// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Retrieve the submitted email and password
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    header("Location: dashboard.php");
    exit();
}
?>