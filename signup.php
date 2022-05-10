<?php
include "conn.php";
session_start();
if (!empty($_SESSION['email'])) {
    header("location: index.php");
}
if (isset($_POST['done'])) {
    $cname = $_POST['cname'];
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $email = trim($email);
    $password = trim($password);
    if (strlen($email) == 0 || strlen($password) == 0) {
        echo "<script> 
           window.alert('Neither email-id nor password can be empty');
           </script>";
    } else {

        $q = "SELECT `email_id` FROM `users` WHERE `email_id`='$email'";
        $result = mysqli_query($conn, $q);
        if (mysqli_num_rows($result) > 0) {

            echo "<script> 
           window.alert('Email-id already registered');
           </script>";
        } else {
            $q = "INSERT INTO `users` (`company name`,`email_id`,`password`) values (
        '$cname','$email','$password')";

            mysqli_query($conn, $q);
            header("location: index.php?mssg=Account Created Susscessfully");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./style/forms-style.css?version=">
    <link rel="stylesheet" href="./style/style.css?version=">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.html"></a>
            <img src="./img/logo-white.png" alt="">
        </div>
        <ul>
            <li><a href="./index.php">Home</a></li>
        </ul>
    </header>

    <form method="POST">
        <h3>SIGN UP</h3>
        <h2>HungerSolverz</h2>
        <label for="cname">Company Name</label>
        <input type="text" id="cname" name="cname" placeholder="Company Name ">

        <label for="email">Email Id</label>
        <input type="email" id="email" name="email" placeholder="Email Id" required>

        <label for="password">Create Password </label>
        <input type="password" id="password" name="password" placeholder="Create Password" required>
        <button type="submit" name="done" id="submit" class="formbutton">Register</button>
        <ul>Already a User? <a href="./userlogin.php">Log In</a> here</ul>
    </form>
</body>

</html>