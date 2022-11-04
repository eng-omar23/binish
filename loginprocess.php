<?php
  session_start();
  require 'db.php';

  $username=$_POST['username'];
  $password=$_POST['password'];
  $btn= $_POST['btnlogin'];

  if($btn!== null)
  {
    if(empty($username) || empty($password)){
      
      echo "<h2 style=color:'red'>All Fields are required</h2>";
      include("index.php");
    }
    else{

      $query = mysqli_query($conn,"select * from users where username='$username' and userpass='$password'");

      $res=mysqli_fetch_array($query);
      
      if(is_array($res)){
        session_start();	
          $_SESSION['username'] = $res['username'];
          $_SESSION['userid'] = $res['usr_id'];
         header("location:nav.php");        
      }
      else
      {
        echo "<h2 style='color: red;'>Wrong credientails please Try Again</h2>";
        include("index.php");
      }


    }
  }
?>


