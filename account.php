<?php
include 'conn.php';
session_start();
if (empty($_SESSION['email'])) {
   header('location: index.php');
}
// $email = $_GET['email'];
// $cname = $_GET['cname'];
$email = $_SESSION['email'];
$cname = $_SESSION['cname'];
if (isset($_POST['done'])) {
   $dname = $_POST['dname'];
   $contact = $_POST['contact'];
   $address = trim($_POST['address']);
   $date = $_POST['date'];
   $time = $_POST['time'];
   $discription = trim($_POST['description']);
   if (strlen($address) == 0 || strlen($discription) == 0 || empty($date) || empty($time) || empty($contact)) {
      echo "
           <script>
              window.alert('Except for name nothing can be left empty');
           </script>
           ";
   } else {
      $q = "INSERT INTO donations (`email`,`company name`,`donor name`,`contact`,`address`,
         `date`,`time`,`description`) values ('$email','$cname','$dname','$contact','$address',
         '$date','$time','$discription')";
         mysqli_query($conn, $q);
      header('location: index.php?mssg=your entry has been recorded and you have been logged out');
   }
}
if (isset($_POST['logout'])) {
   session_unset();
   session_destroy();
   header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Account Page</title>
   <!-- <link rel="stylesheet" href="./style/account-style.css"> -->
   <link rel="stylesheet" href="./style/acc-style.css?version=">
   <link rel="stylesheet" href="./style/style.css?version=">
   <link rel="stylesheet" href="./style/table-style.css?version=">

</head>

<body> 
      <header>
         <div class="logo">
            <a href="index.php">
            <img src="./img/logo-white.png" alt=""></a>
         </div>
         <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
            <li><a href="account.php"><?php echo $_SESSION['email'] ?></a></li>
         </ul>
      </header>

   <div>
      <form method="post">
         <div class="row">
            <div class="formtext">
               <label for="cname">Company Name : </label>
               <label for="email">Email-Id : </label>
               <label for="dname">Name : </label>
               <label for="contact">Contact No : </label>
               <label for="address">Address : </label>
               <label for="date">Date : </label>
               <label for="time">Time : </label>
               <label for="discription">Food Discription : </label>
            </div>
            <div class="userinput">
               <input type="text" id="cname" value=<?php echo $cname?> readonly>
               <input type="email" id="email" value=<?php echo $email ?> readonly>
               <input type="text" id="dname" name="dname">
               <input type="number" id="contact" name="contact">
               <input type="text" id="address" name="address">
               <input type="date" id="date" name="date">
               <input type="time" id="time" name="time">
               <input type="text" id="discription" name="description">
            </div>
         </div>
         <input class="formbutton" type="submit" name="done" id="submit">
      </form>
   </div>
   <br>
   <div class="history">
      <h1>
         PAST HISTORY
      </h1>
      <br>
      <table>
         <thead>
            <tr>
               <th>S. No.</th>
               <th>Contact</th>
               <th>Address</th>
               <th>Date</th>
               <th>Time</th>
               <th>Description</th>
               <th>Status</th>
               <th>Remarks</th>
               <th>Attender email</th>
            </tr>
         </thead>
         <tbody>
         <?php
         $q = "SELECT * FROM donations where `email`='$email'";
         $result = mysqli_query($conn, $q);
         if (mysqli_num_rows($result) > 0) {
            while ($entry = mysqli_fetch_assoc($result)) {
               echo "
                      <tr>
                       <td>" . $entry['sno']. "</td>
                       <td>" . $entry['contact'] . "</td>
                       <td>" . $entry['address'] . "</td>
                       <td>" . $entry['date'] . "</td>
                       <td>" . $entry['time'] . "</td>
                       <td>" . $entry['description'] . "</td>
                       <td>" . $entry['status'] . "</td>
                       <td>" . $entry['remarks'] . "</td>
                       <td>" . $entry['volunteer_id'] . "</td>
                      </tr>
                    ";
            }
         }
         ?>
         </tbody>
      </table>
   </div>

   <script>
      let date = new Date();
      //    console.log(date);
      date.setDate(date.getDate() + 1);
      let day = date.getDate();
      let month = date.getMonth() + 1;
      let year = date.getFullYear();
      console.log(year);
      console.log(month);
      console.log(day);
      if (day < 10)
         day = "0" + day;
      if (month < 10)
         month = "0" + month;
      let m = year + "-" + month + "-" + day;
      console.log(m);
      document.getElementById('date').min = m;
      date.setDate(date.getDate() + 30);
      day = date.getDate();
      month = date.getMonth() + 1;
      year = date.getFullYear();
      if (day < 10)
         day = "0" + day;
      if (month < 10)
         month = "0" + month;
      let M = year + "-" + month + "-" + day;
      document.getElementById('date').max = M;
   </script>
</body>

</html>