<?php
include("db.php");
session_start();
if(isset($_POST['pname'])){

  $name = $_POST['pname'];
  $id  = $_POST['pid'];
  $quan = $_POST['quantity'];
  $mr = $_POST['mrp'];
  $tx = $_POST['tax'];
  $s = "select * from pro where product_id = '$id'";
  $result = mysqli_query($con, $s);
  $num  =  mysqli_num_rows($result);
  if ($num == 1){
  $_SESSION["error"] = "Product not added give a unique product ID";
  $_SESSION['msg_type'] = "warning";
  }
  else{
    $_SESSION['mes'] = "Product Added Sucessfully";
    $_SESSION['msg_type'] = "success";
  $reg = "insert into pro (product_id , product_name, Available_amount, MRP,tax)  values ('$id','$name','$quan','$mr','$tx')";
  mysqli_query($con, $reg);

}
}

if(isset($_POST['upname'])){

  $uname = $_POST['upname'];
  $uid  = $_POST['upid'];
  $uquan = $_POST['uquantity'];
  $umr = $_POST['umrp'];
  $utx = $_POST['utax'];
  $s = "select * from pro where product_id = '$uid'";
  $result = mysqli_query($con, $s);
  $num  =  mysqli_num_rows($result);
  if ($num == 1){

    $_SESSION['mes1'] = "Product Updated Sucessfully";
    $_SESSION['msg_type'] = "success";
  $reg = "update pro set  product_name = '$uname', Available_amount = '$uquan', MRP = '$umr',tax = '$utx' where product_id = '$uid'";
  mysqli_query($con, $reg);
  }
  else{


    $_SESSION["error1"] = " Invalid product ID";
    $_SESSION['msg_type'] = "warning";

}
}








if(isset($_POST["id"])){

  $ID =  $_POST["id"];
  $w = "delete from pro where product_id = $ID";
  $result = mysqli_query($con,$w);
  $_SESSION['message'] = "Record has been deleted";
  $_SESSION['msg_type'] = "danger";


}
if(isset($_POST["id2"])){

  $ID =  $_POST["id2"];
  $w = "select * pro where product_id = $ID";
  $result = mysqli_query($con,$w);
  $row = mysqli_fetch_array($result);








}
 ?>


<!DOCTYPE html>
<html>

<head>
<link rel = "stylesheet" type = "text/css" href = "./c.css">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>



  <nav class="navbar navbar-inverse">
 <div class="container-fluid">
   <div class="navbar-header">
     <a class="navbar-brand" href="#">WebSiteName</a>
   </div>
   <ul class="nav navbar-nav">
     <li ><a href="./index.php">Bill</a></li>

     <li class = "active"><a href="./stock.php">Stock Management</a></li>
     <li><a href="./company.php">Company Name</a></li>


   </ul>
   <ul class="nav navbar-nav navbar-right">

     <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
   </ul>
 </div>
</nav>


  <?php

  if(isset($_SESSION['mes'])): ?>

  <div class = "alert alert-<?=$_SESSION['msg_type']?>">

  <?php
  echo $_SESSION['mes'];
  unset($_SESSION['mes'] );
  ?>
</div>
<?php endif ?>


  <?php

  if(isset($_SESSION['mes1'])): ?>

  <div class = "alert alert-<?=$_SESSION['msg_type']?>">

  <?php
  echo $_SESSION['mes1'];
  unset($_SESSION['mes1'] );
  ?>
</div>
<?php endif ?>



  <?php

  if(isset($_SESSION['error'])): ?>

  <div class = "alert alert-<?=$_SESSION['msg_type']?>">

  <?php
  echo $_SESSION['error'];
  unset($_SESSION['error'] );
  ?>
</div>
<?php endif ?>


  <?php

  if(isset($_SESSION['error1'])): ?>

  <div class = "alert alert-<?=$_SESSION['msg_type']?>">

  <?php
  echo $_SESSION['error1'];
  unset($_SESSION['error1'] );
  ?>
</div>
<?php endif ?>


  <?php

  if(isset($_SESSION['message'])): ?>

  <div class = "alert alert-<?=$_SESSION['msg_type']?>">

  <?php
  echo $_SESSION['message'];
  unset($_SESSION['message'] );
  ?>
</div>
<?php endif ?>






<div class = "container">
  <div class="card">
    <div class="card-body" style="width: 100%;">

<table class="table table-bordered">
  <thead>

    <tr>

      <th>Product Id</th>
      <th>Product Name</th>
      <th>Available Amount &nbsp </th>
      <th>Unit Price &nbsp</th>
      <th>Tax % &nbsp</th>
      <th>Delete &nbsp</th>
      <th>Update &nbsp</th>

    </tr>
  </thead>
  <tbody>
    <?php

    include('db.php');



      $s = "select * from pro";
      $result = mysqli_query($con,$s);
      $num = mysqli_num_rows($result);
      $n = 0;
      while($row = mysqli_fetch_array($result))
      {




        $_SESSION["pid"] = $row['product_id'];
          echo "<tr>";
              echo "<td>" . $row['product_id'] . "</td>";
              echo "<td>" . $row['product_name'] . "</td>";
              echo "<td>" . $row['Available_amount'] . "</td>";
              echo "<td>" . $row['MRP'] . "</td>";
              echo "<td>" . $row['tax'] . "</td>";
              echo "<td>
              <form method  = 'post'>
              <input type='hidden' name='id' value='" . $row['product_id'] . "' /><input type='submit' id='".$row['product_id']."' class='btn btn-danger' name='Add' value ='Delete'>
              </form>






              </td>";
              echo '
              <td>

              <button   class = "btn btn-info " name="id2" value="' . $row['product_id'] . '" data-toggle="modal" data-target="#myModal">Update</button>


              <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit</h4>
                    </div>
                    <div class="modal-body">

                      <form method = "post">
                        <div class="form-group">
                        <label for="prd1">Product Name :</label>
                        <input type="text" class="form" id="uprd" name = "upname">
                        </div>
                      <div class="form-group">
                      <label for="prd2">Product ID :&nbsp &nbsp &nbsp &nbsp </label>
                      <input type="text" class="form" id="uprd" name = "upid">
                      </div>
                      <div class="form-group">
                       <label for="quantity1">Quantity : &nbsp &nbsp &nbsp &nbsp  &nbsp </label>
                       <input type="float" class="form" id="uquantity" min = "1" name = "uquantity">
                      </div>
                      <div class="form-group">
                       <label for="quantity2">Unit Price : &nbsp &nbsp &nbsp &nbsp </label>
                       <input type="float" class="form" id="umrp" min = "1" name = "umrp">
                      </div>
                      <div class="form-group">
                       <label for="tax">Tax %: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
                       <input type="float" class="form" id="ut" min = ".01" name = "utax">
                      </div>


                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                      </form>

                    </div>

                  </div>

                </div>
              </div>








              </td>


              ';

          echo "</tr>";
      }







     ?>


  </tbody>
</table>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" align = "right">
  Add new product
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method = "post">
          <div class="form-group">
          <label for="prd1">Product Name :</label>
          <input type="text" class="form" id="prd" name = "pname">
          </div>
       <div class="form-group">
      <label for="prd2">Product ID :&nbsp &nbsp &nbsp &nbsp </label>
      <input type="text" class="form" id="prd" name = "pid">
      </div>
       <div class="form-group">
         <label for="quantity1">Quantity : &nbsp &nbsp &nbsp &nbsp  &nbsp </label>
         <input type="float" class="form" id="quantity" min = "1" name = "quantity">
       </div>
       <div class="form-group">
         <label for="quantity2">Unit Price : &nbsp &nbsp &nbsp &nbsp </label>
         <input type="float" class="form" id="quantity" min = "1" name = "mrp">
       </div>
       <div class="form-group">
         <label for="tax">Tax %: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
         <input type="float" class="form" id="t" min = ".01" name = "tax">
       </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>






<?php
  if(isset($_POST["id2"]))
{?>

<script type="text/javascript">
    document.getElementById('99').submit(); // SUBMIT FORM
</script>

<?php
}

?>




</div>
</div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
