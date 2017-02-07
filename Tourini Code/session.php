<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select * from User where uname = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['uname'];
   $uid   = $row['uid'];
   $fName = $row['firstName'];
   $lName = $row['lastName'];
   $dob = $row['dob'];
   $sex= $row['gender'];     
   $profilePic = $row['profilePic'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
?>
