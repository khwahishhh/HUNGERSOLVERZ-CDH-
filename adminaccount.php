<?php
include "conn.php";
session_start();
if (empty($_SESSION['admin_email'])) {
   header("location: index.php");
}
$email = $_SESSION['admin_email'];

if (isset($_POST['logout'])) {
   session_unset();
   session_destroy();
   //  echo "<br>yeps<br>";
   header("location: index.php");
}

if(isset($_POST['update'])){
   $remarks = $_POST['remarks'];
   if(strlen($remarks)==0)
   {
      echo "
          <script>
             alert('remarks cannot be empty');
          </script>
      ";
   }
   else
   {
      $attender = $_POST['attender'];
      $sno = $_POST['sno'];
      $status = $_POST['status'];
      if($status=="")
      {
         echo "
          <script>
             alert('status cannot be empty');
          </script>
      ";
      }
      else{
      $q = "UPDATE donations
            SET `status`='$status', `remarks`='$remarks', `volunteer_id`='$attender'
            where `sno` = '$sno'
          ";
          mysqli_query($conn, $q);      
          header('location: index.php');
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
   <title>Admin Account</title>
   <link rel="stylesheet" href="./style/acc-style.css?version=">
   <link rel="stylesheet" href="./style/style.css?version=">
   <link rel="stylesheet" href="./style/table-style.css?version=">
   <link rel="stylesheet" href="./style/update-style.css?version=">
</head>

<body>
   <header>
      <div class="logo">
         <a href="index.html"></a>
         <img src="./img/logo-white.png" alt="">
      </div>
      <ul>
         <li><a href="./index.php">Home</a></li>
         <li><a href="logout.php">LOGOUT</a></li>
         <li><a href="adminaccount.php"><?php echo $_SESSION['admin_email'] ?></a></li>
      </ul>
   </header>
   <br>
   <div class="adminhistory"> 
   <table class="admintable" >
      <thead>
         <tr>
            <th>S. No.</th>
            <th>Email-Id</th>
            <th>Company Name</th>
            <th>Donor name</th>
            <th>contact</th>
            <th>address</th>
            <th>date</th>
            <th>time</th>
            <th>Description</th>
            <th>Status</th>
            <th>Remarks</th>
            <th>Attender email</th>
         </tr>
      </thead>
      <tbody>

         <?php
      $q = "SELECT * FROM donations";
      
      $result = mysqli_query($conn, $q);
      
      if (mysqli_num_rows($result) > 0) {
         while ($entry = mysqli_fetch_assoc($result)) {
            echo "
            <tr onclick='update(this.children[0].innerHTML,this.children[9].innerHTML)'>
            <td>" . $entry['sno'] . "</td>
            <td>" . $entry['email'] . "</td>
            <td>" . $entry['company name'] . "</td>
            <td>" . $entry['donor name'] . "</td>
            <td>" . $entry['contact'] . "</td>
            <td>" . $entry['address'] . "</td>
            <td>" . $entry['date'] . "</td>
            <td>" . $entry['time'] . "</td>
            <td>" . $entry['description'] . "</td>
            <td>" . $entry['status'] . "</td>
            <td id='remarks'>" . $entry['remarks'] . "</td>
            <td>" . $entry['volunteer_id'] . "</td>
           </tr>
            ";
         }
      }
      
      ?>
      </tbody>
   </table>
   </div>

   <div id="update">
      <form method="post">
      sno : <input id="sno" name="sno" readonly>
      <input type="radio" name="status" value="COMPLETED AND CLOSED"> COMPLETED AND CLOSED
      <input type="radio" name="status" value="INCOMPLETE AND CLOSED"> INCOMPLETE AND CLOSED
      <br>
      email: <input type="test"  name="attender" value=<?php echo $email ?> readonly><br>
      <textarea name="remarks" placeholder="remarks"></textarea>
      <button type="submit" name="update">SUBMIT</button>
      <button id="back" >BACK</button>
   </form>
   </div>

   <script defer src="./scripts/update-script.js"></script>

</body>

</html>