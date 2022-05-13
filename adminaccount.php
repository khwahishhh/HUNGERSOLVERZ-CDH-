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

if (isset($_POST['update'])) {
   $remarks = $_POST['remarks'];
   if (strlen($remarks) == 0) {
      echo "
          <script>
             alert('remarks cannot be empty');
          </script>
      ";
   } else {
      $attender = $_POST['attender'];
      $sno = $_POST['sno'];
      $status = $_POST['status'];
      if ($status == "") {
         echo "
          <script>
             alert('status cannot be empty');
          </script>
      ";
      } else {
         $q = "UPDATE donations
            SET `status`='$status', `remarks`='$remarks', `volunteer_id`='$attender'
            where `sno` = '$sno'
          ";
         mysqli_query($conn, $q);
         header('location: adminaccount.php');
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
   <link rel="stylesheet" href="./style/acc-style.css?version=10">
   <link rel="stylesheet" href="./style/style.css?version=">
   <link rel="stylesheet" href="./style/table-style.css?version=3">
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
         <li><a href="adminaccount.php"><?php echo $_SESSION['admin_email'] ?></a></li>
      </ul>
   </header>
   <br>
   <div class="adminhistory">
      <table class="admintable">
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
            <tr id='row' onclick='update(this.children[0].innerHTML,this.children[9].innerHTML)'>
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
            <div class="row">
               <div class="formtext">
                  <label for="sno">S. No. : </label>
                  <label for="email">Email-Id : </label>
                  <!-- <label for="email">Customer : </label> -->
                  <br>
                  <input type="radio" name="status" value="COMPLETED AND CLOSED">
                  <input type="radio" name="status" value="INCOMPLETE AND OPEN">
                  <br>
                  <label for="remarks">Remarks : </label>
               </div>
               <div class="userinput">
                  <input id="sno" name="sno" readonly>
                  <input type="test" name="attender" value=<?php echo $email ?> readonly>
                  <!-- want to read the donor name in read only type -->
                  <br>
                  <label style="text-align: left;" for="email">COMPLETED AND CLOSED</label>
                  <label style="text-align: left;" for="email">INCOMPLETE AND OPEN</label>
                  <br>
                  <textarea name="remarks" placeholder="Remarks"></textarea>
               </div>
            </div>
            <div class="buttonsupdate">
               <br>
               <button class="formbutton" type="submit" name="update">SUBMIT</button>
               <button class="formbutton" type="submit" id="back">BACK</button>
            </div>
         </form>
      </div>
  
      <script defer src="./script/update-script.js"></script>

</body>

</html>