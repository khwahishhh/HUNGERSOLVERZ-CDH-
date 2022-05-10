<?php
   //Here we are setting the server name, user name and password of the database where our table is stored
   $servername = "localhost";
   $username = "root";
   $password = "";

   //Here we are establishing connection to the serevr
   $conn = mysqli_connect($servername,$username,$password);

   //here we are connection to the database
   mysqli_select_db($conn,"hungersolverz");

   if(!$conn){
       echo "not connected";
   }

?>