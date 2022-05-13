<?php
session_start();
if (array_key_exists('mssg', $_GET)) {
   $mssg = $_GET['mssg'];
   if (trim($mssg) == "your account has been created") {
      echo "
     <script>
       window.alert('your account has been created');
     </script>
     ";
   } else {
      echo "
        <script>
          window.alert('your entry has been recorded and you have been redirected to home page');
        </script>
        ";
   }
}

if (isset($_POST['logout'])) {
   session_unset();
   session_destroy();
   //  echo "<br>yeps<br>";
   header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Food Donation Point</title>
   <link rel="stylesheet" href="style/style.css?version=1">
   <link rel="stylesheet" href="./style/team-style.css?version=1">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
   <div>
      <header>
         <div class="logo">
            <a href="index.php">
            <img src="./img/logo-white.png" alt=""></a>
         </div>
         <ul>
            <?php if (empty($_SESSION['email']) && empty($_SESSION['admin_email'])) { ?>
               <li><a href="userlogin.php">LOGIN</a></li>
               <li><a href="signup.php">SIGN UP</a></li>
               <li><a href="contact.html">CONTACT US</a></li>
            <?php } else { ?>
               <li><a href="logout.php">LOGOUT</a></li>
               <li><a href="contact.html">CONTACT US</a></li>
               <?php if (empty($_SESSION['admin_email'])) { ?>
                  <li><a href="account.php">ACCOUNT -- <?php echo $_SESSION['email'] ?></a></li>
               <?php } else { ?>
                  <li><a href="adminaccount.php">ADMIN ACCOUNT -- <?php echo $_SESSION['admin_email'] ?></a></li>
               <?php } ?>
            <?php } ?>
         </ul>
      </header>
   </div>
   <br>
   <div>
      </ul>
      <div class=" content">
         <h1>ABOUT US</h1>
         <div class="para">
            Food is one of the necessities of humans, and it stands first among all basic needs - food, shelter, and
            clothing. It is important as it nourishes the human body- sustains the very existence of humans.
            However, with the rising population and development of this country, food wastage has risen to a new
            high.
            <br><br> We have developed a website which will serve as an intermediate between the peopel who want to donate
            and the people who face food scarcity. In not just India but all around the world many functions are organised daily on various different occasions.
            Like marraiges, birthdays etc.Lots, of food gets wasted in these functions as more food is produced and people
            consume less. On our website the people organising the function can register in advance, so that we can go later
            and collect food that has not been consumed and distrubute among the needy. Other people also who wish to donate food can use our website.
         </div>
         <a href="https://www.youtube.com/watch?v=rtW3L0uhi8s">
            <button type="button"><span></span>WATCH MORE</button>
         </a>
      </div>
   </div>
   <br>

   <div class="team">
      <h1>Our Team</h1>
      <div class="our_team">
         <div class="team_member">
            <div class="member_img">
               <img src="./img/parmeet-sq.jpeg" alt="our_team">
               <div class="social_media">
                  <div class="linkedin item"><a href="https://www.linkedin.com/in/singhparmeet011102/"><i class="fa fa-linkedin"></i></a></div>
                  <div class="instagram item"><a href="https://www.instagram.com/parmeet_singh.meet/"><i class="fa fa-instagram"></i></a></div>
               </div>
            </div>
            <h3>Parmeet <br> Singh</h3>
            <h4>Front-end Developer <br> + <br> Front-end Tester</h4>
         </div>
         <div class="team_member">
            <div class="member_img">
               <img src="./img/chirag-sq.jpeg" alt="our_team">
               <div class="social_media">
                  <div class="linkedin item"><a href="https://www.linkedin.com/in/chirag-lala-830463190/"><i class="fa fa-linkedin"></i></a></div>
                  <div class="instagram item"><a href="https://www.instagram.com/_0chirag0_/"><i class="fa fa-instagram"></i></a></div>
               </div>
            </div>
            <h3>Chirag <br> Lala</h3>
            <h4>Back-end Developer <br> + <br>Back-end Tester</h4>
         </div>
         <div class="team_member">
            <div class="member_img">
               <img src="./img/khwahish-sq.jpg" alt="our_team">
               <div class="social_media">
                  <div class="linkedin item"><a href="https://www.linkedin.com/in/khwahish-agarwal-25a302214/"><i class="fa fa-linkedin"></i></a></div>
                  <div class="instagram item"><a href="https://www.instagram.com/khwahishhh____/"><i class="fa fa-instagram"></i></a></div>
               </div>
            </div>
            <h3>Khwahish <br> Agarwal</h3>
            <h4>Front-end Developer <br> + <br> UI Designer</h4>
         </div>
         <div class="team_member">
            <div class="member_img">
               <img src="./img/yash-sq.jpeg" alt="our_team">
               <div class="social_media">
                  <div class="linkedin item"><a href="https://www.linkedin.com/in/yash-srivastava-506983201/"><i class="fa fa-linkedin"></i></a></div>
                  <div class="instagram item"><a href="https://www.instagram.com/_dr_dead/"><i class="fa fa-instagram"></i></a></div>
               </div>
            </div>
            <h3>Yash Srivastava</h3>
            <h4>Data Management <br> + <br> Documentation</h4>
         </div>
      </div>
   </div>

   <div class="footer">
      <ul>
         <h1>HUNGERSOLVERZ&copy;</h1>
         <h4>*This Website is made under the minor project. Copyright</h4>

      </ul>
   </div>

</body>

</html>