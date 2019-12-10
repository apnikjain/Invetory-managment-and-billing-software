<!DOCTYPE html>
<html>
<?php
session_start();
include('db.php');
if(isset($_POST['com'])){
  $ncom = $_POST['com'];
  $ncomad = $_POST['comad'];
  $delete = 'delete from company';
  mysqli_query($con, $delete);
  $reg = "insert into company (com,addr)  values ('$ncom','$ncomad')";
  mysqli_query($con, $reg);
  echo "Name changed sucessfully";
}



?>
<head>
  <link rel = "stylesheet" type = "text/css" href = "./c.css">
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script></head>
<body>
  <nav class="navbar navbar-inverse">
 <div class="container-fluid">
   <div class="navbar-header">
     <a class="navbar-brand" href="./home.php">WebSiteName</a>
   </div>
   <ul class="nav navbar-nav">
     <li><a href="./index.php">Bill</a></li>

     <li><a href="./stock.php">Stock Management</a></li>
     <li class = "active"><a href="./company.php">Company Name</a></li>

   </ul>
   <ul class="nav navbar-nav navbar-right">

     <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
   </ul>
 </div>
</nav>


<div style = "padding-left: 1%; padding-top: 1%; ">
  <form method = "post">
    <div class="form-group">
    <label for="prd1">Company Name&nbsp&nbsp</label>
    <input type="text" class="form" id="com" name = "com">
    </div>
    <div class="form-group">
    <label for="prd1">Company Address&nbsp&nbsp</label>
    <input type="text" class="form" id="comad" name = "comad">
    </div>

<br>
 <button type="submit" class="btn btn-default">Change</button>

  </form>


</div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
