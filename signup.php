<?php

include("db.php");
  session_start();

  if(isset($_POST['name'])) {

     $nname = $_POST['name'];
     $myusername = $_POST['username'];
     $mypassword = $_POST['password'];

     $s = "select * from employe where userid = '$myusername'";
     $result = mysqli_query($con, $s);
     $num  =  mysqli_num_rows($result);
     if ($num == 1){
     echo "Give a unique product ID";
     }
     else{
     $reg = "insert into employe (name , userid, password)  values ('$nname','$myusername','$mypassword')";
     mysqli_query($con, $reg);
     echo "Product added sucessfully";
   }
  }

 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="c2.css">
</head>
<body>
  <div class="header">
  	<h2>Sign Up</h2>
  </div>

  <form method="post" >

    <div class="input-group">
  		<label>Name</label>
  		<input type="text" name="name" >
  	</div>

    <div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" >Signup</button>
  	</div>

  </form>
</body>
</html>
