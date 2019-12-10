<?php

include ('db.php');

session_start();


 if(isset($_POST['username'])) {


   $myusername = $_POST['username'];
   $mypassword = $_POST['password'];

   $sql = "SELECT userid FROM employe WHERE password = '$mypassword'";
   $result = mysqli_query($con,$sql);
   $row = mysqli_fetch_array($result);


   $count = mysqli_num_rows($result);



   if($count == 1) {

      $_SESSION['username'] = $myusername;

      header("location: home.php");
   }else {
      $error = "Your Login Name or Password is invalid";
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
  	<h2>Login</h2>
  </div>

  <form method="post" action = "login.php">

  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  	<button type="submit" class="btn" name="login_user">Login</button>

  	</div>

  </form>
  <a href="signup.php"><button  class="btn" > Sign up</button></a>
</body>
</html>
