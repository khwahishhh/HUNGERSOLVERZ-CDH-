<?php
include "conn.php";
session_start();
if (!empty($_SESSION['admin_email'])) {
    header('location: index.php');
}
if (isset($_POST['done'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (strlen($email) == 0 || strlen($password) == 0) {
        echo "
           <script>
              window.alert('Neither email nor password can be empty');
           </script>
           ";
    } else {
        $q = "SELECT * FROM `admins` where `email`='$email'";
        $result = mysqli_query($conn, $q);

        if (mysqli_num_rows($result) == 0) {
            echo "
                <script>
                   window.alert('This email has not been registered\nContact the Adminstrator');
                </script>
                ";
        } else {
            $entry = mysqli_fetch_assoc($result);
            if ($entry['password'] != $password) {
                echo "
                    <script>
                       window.alert('password is incorrect');
                    </script>
                    ";
            } else {
                $_SESSION['admin_email'] = $email;
                // header('location: adminaccount.php?email='.$email);
                header('location: adminaccount.php');
            }
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
    <link rel="stylesheet" type="text/css" href="./style/forms-style.css?version=">
    <link rel="stylesheet" href="./style/style.css?version=">
    <title>User Login</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.html"></a>
            <img src="./img/logo-white.png" alt="">
        </div>
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./userlogin.php">USER LOGIN</a></li>
        </ul>
    </header>

    <form method="POST">
        <h3>ADMIN LOGIN</h3>
        <h2>HungerSolverz</h2>
        <!-- <label for="email">Email-id : </label>
                <input type="text" name="email" id="email" placeholder="Enter Your Email Id"><br>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" placeholder="Enter Your Password"><br>
                <input type="submit" id="submit" name="done" value="Submit">  -->

        <label for="email">Username/Email ID *</label>
        <input type="email" id="email" name="email" placeholder="Username/Email Id" required>

        <label for="password">Password *</label>
        <input type="password" id="password" name="password" placeholder="Password" required>

        <button type="submit" name="done" id="submit" class="formbutton">LOG IN</button>
    </form>
</body>

</html>