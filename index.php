<?php

function data(){


include('db.php');

session_start();
$id0 = "ap123";
if(isset($_POST['iid'])){
  $nid = $_POST['iid'];
  $nquan = $_POST['nq'];

  $ncus = $_POST['cus'];
  $naddr = $_POST['addrs'];
  $nph = $_POST['phone'];



  $reg = "insert into party (name,addr,phone)  values ('$ncus','$naddr','$nph')";
  mysqli_query($con, $reg);






  $s = "select * from pro";
  $result = mysqli_query($con,$s);
  $num = mysqli_num_rows($result);
  $ap = "select * from dis";
  $result6 = mysqli_query($con,$ap);
  $num6 = mysqli_num_rows($result6);
  $error = 0;
  while($row = mysqli_fetch_array($result))
  {

    if ($nid == $row['product_id'])
    {


      $a1 =  $row['product_id'];
      $a2 = $row['product_name'];
      $a3 =  $nquan ;
      $a4 =  $row['MRP'] ;
      $a5 =  ($row['MRP'])*($nquan);
      $a6 = ($row['tax']*100);
      if($a3<=$row['Available_amount'])
      {
      $n=$num6+1;
      $reg = "insert into dis (SNo ,user_id, pro_id , pro_name, given_quantity, unit_price,tax, total)  values ('$n','$id0','$a1','$a2','$a3','$a4','$a6','$a5')";
      mysqli_query($con, $reg);
      $reg7 = "update pro set Available_amount = $row[Available_amount]-$a3 where product_id = $a1";
      mysqli_query($con,$reg7);


      }
      else {
      echo '
<div class="alert alert-info" role="alert">Limited Stock!</div>';

      }
      $error =$error+1;
    }


  }

  if($error == 0){

    echo '
    <div class="alert alert-danger" role="alert">Product not Available!</div>';


  };

  $id0 = "ap123";

  $d = "select * from dis where user_id = '$id0' ";
  $result2 = mysqli_query($con,$d);

  $t = 0;
  $ta = 0;
  while($row1 = mysqli_fetch_array($result2)){

      echo "<tr>";
          echo "<td>" . $row1['SNo'] . "</td>";
          echo "<td>" . $row1['pro_id'] . "</td>";
          echo "<td>" . $row1['pro_name'] . "</td>";
          echo "<td>" . $row1['given_quantity'] . "</td>";
          echo "<td>" . $row1['tax'] . "</td>";
          echo "<td>" . $row1['unit_price'] . "</td>";
          echo "<td>" . $row1['total'] . "</td>";
      echo "</tr>";
      $t = $t+$row1['total'];
      $ta = $ta+$row1['tax'];


  }

  echo "<tr>";
      echo "<td colspan = '6' style = 'text-align : right;'>  Total  </td>";

      echo "<td>".number_format($t, 2)."</td>";
  echo "</tr>";
  $pt = $t+$ta;
  echo "<tr>";
      echo "<td colspan = '6' style = 'text-align : right;'>Total  Tax  </td>";

      echo "<td>".number_format($ta, 2)."</td>";
  echo "</tr>";

  echo "<tr>";
      echo "<td colspan = '6' style = 'text-align : right;'> Grand Total  </td>";

      echo "<td>".number_format($pt, 2)."</td>";
  echo "</tr>";


}


}
function fdata(){

include('db.php');
session_start();
$id0 ="ap123";
$output = '';
$output2 = '';




  $d = "select * from dis where user_id = '$id0'";
  $result2 = mysqli_query($con,$d);
  $num2 = mysqli_num_rows($result2);
  $t = 0;
  while($row1 = mysqli_fetch_array($result2)){

      $output .=  '<tr>
          <td>' . $row1['SNo'] . '</td>
          <td>' . $row1['pro_id'] . '</td>
          <td>' . $row1['pro_name'] . '</td>
          <td>' . $row1['given_quantity'] .'</td>
          <td>'. $row1['unit_price'] . '</td>
          <td>'. $row1['tax'] . '</td>
          <td>' . $row1['total'] . '</td>
       </tr>';
      $t = $t+$row1['total'];


  }

  return $output;


}



function fdata2(){

  include('db.php');

  $id0 = "ap123";
  $output = '';
  $output2 = '';





  $d = "select * from dis where user_id = '$id0'";
  $result2 = mysqli_query($con,$d);
  $num2 = mysqli_num_rows($result2);
  $t = 0;
  $ta = 0;
  while($row1 = mysqli_fetch_array($result2)){

      $output .=  '<tr>
          <td>' . $row1['SNo'] . '</td>
          <td>' . $row1['pro_id'] . '</td>
          <td>' . $row1['pro_name'] . '</td>
          <td>' . $row1['given_quantity'] .'</td>
          <td>'. $row1['unit_price'] . '</td>
          <td>'. $row1['tax'] . '</td>
          <td>' . $row1['total'] . '</td>
       </tr>';
      $t = $t+$row1['total'];
      $ta = $ta+$row1['tax'];

  }
  $pt = $t+$ta;
  $output2 .= '

  <tr>
      <td colspan = "6" style = "text-align : right;">  Total  </td>

       <td>'.$t.'</td>
  </tr>
  <tr>
    <td colspan = "6" style = "text-align : right;">Total  Tax  </td>

    <td>'.$ta.'</td>
  </tr>
  <tr>
      <td colspan = "6" style = "text-align : right;"> Grand Total  </td>

      <td>'.$pt.'</td>
  </tr>



   ';

  return $output2;

}



if(isset($_POST["pdf"])){

  include("db.php");
  $dt3 = new DateTime();

  $company_name = "select * from company";
  $result5 = mysqli_query($con,$company_name);
  $row5 = mysqli_fetch_array($result5);


  $party_name = "select * from party";
  $result10 = mysqli_query($con,$party_name);
  $row11 = mysqli_fetch_array($result10);




  require_once("tcpdf/tcpdf.php");
  require_once("tcpdf/tcpdf_autoconfig.php");
  require_once("tcpdf/tcpdf_barcodes_1d.php");
  require_once("tcpdf/tcpdf_barcodes_2d.php");
  require_once("tcpdf/tcpdf_import.php");
  require_once("tcpdf/tcpdf_parser.php");

  $obj_pdf = new TCPDF('P',PDF_UNIT, PDF_PAGE_FORMAT,true,'UTF-8',false);
  $obj_pdf ->AddPage();
  $obj_pdf->SetCreator(PDF_CREATOR);
  $obj_pdf->SetTitle("pdf");
  $obj_pdf->SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
  $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
  $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_MAIN));
  $obj_pdf->SetDefaultMonospacedFont('helvetica');
  $obj_pdf->SetFooterMArgin(PDF_MARGIN_FOOTER);
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
  $obj_pdf->setPrintHeader(false);
  $obj_pdf->setPrintFooter(false);
  $obj_pdf->SetAutoPageBreak(TRUE,10);
  $obj_pdf->SetFont('helvetica','',12);

  $content = '';
  $content .= '
            <table border = "1" cellspacig = "0" cellpadding = "5">
            <tr>
              <td width = "50%" >'.$row5['com'].'<br><br>'.$row5['addr'].'<br></td>
              <td width = "50%" align ="center">Date:' .date("d/m/Y").'<br><br></td>
            </tr>
            <tr>
              <td width = "100%" >Customer<br>'.$row11['name'].'<br>'.$row11['addr'].'<br>'.$row11['phone'].'</td>

            </tr>

              <tr>
                <th width = "5%">SNo</th>
                <th width = "10%">ID</th>
                <th width = "25%">Item Description</th>
                <th width = "15%">Quantity</th>
                <th width = "15%">unit price</th>
                <th width = "15%">Tax(Rs.)</th>
                <th width = "15%">Total</th>
              </tr>';
  $content .= fdata();
  $content .= fdata2();
  $content .= '</table>';
  $obj_pdf->writeHTMLCell(0, 0 , '' , '' , $content);
  $obj_pdf->Output("sample.pdf","I");
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
     <a class="navbar-brand" href="./home.php">WebSiteName</a>
   </div>
   <ul class="nav navbar-nav">
     <li class="active"><a href="./index.php">Bill</a></li>
     <li><a href="./stock.php">Stock Management</a></li>
     <li><a href="./company.php">Company Name</a></li>

   </ul>
   <ul class="nav navbar-nav navbar-right">

     <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
   </ul>
 </div>
</nav>

<div class = "container" style = "height:10%; !important">
<div class = "centered">


   <form method = "post">
     <div class="form-group">
    <label for="prd">Customer Name :&nbsp&nbsp </label>
    <input type="text" class="form" id="cus" name = "cus">
  </div>
  <div class="form-group">
 <label for="prd">Place of Supply :    &nbsp&nbsp</label>
 <input type="text" class="form" id="addrs" name = "addrs">
</div>
<div class="form-group">
<label for="prd">Phone : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
<input type="text" class="form" id="phone" name = "phone">
</div>


</div>
<div style = "padding-left: 50%; padding-top: 1.1%;">
  <div class="form-group">
 <label for="prd">Product id :</label>
 <input type="text" class="form" id="prd" name = "iid">
</div>
  <div class="form-group">
    <label for="quantity">Quantity : &nbsp&nbsp </label>
    <input type="Float" class="form" id="quantity" min = "1" name = "nq">
  </div>
  <br><br><br>
    <button type="submit" class="btn btn-success">Add</button>&nbsp &nbsp &nbsp<a  href = "./delete.php"><button type="button" class="btn btn-danger">Create New Bill
    </button></a>
</div>
</form>


</div>





<br><br>

<div class="container" style = "padding-left: 10%; ">

  <table class="table table-bordered">
    <thead>

      <tr>
        <th>S.No.</th>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Quantity &nbsp </th>
        <th>Tax(Rs.) &nbsp </th>
        <th>MRP &nbsp</th>
        <th>Total Amount</th>
      </tr>
    </thead>
    <tbody>



      <?php
        echo data();
       ?>
















    </tbody>
  </table>
  <div style = "padding-left : 84%; padding-top : 5%;">
  <form method  = "post">
  <input type = "submit" name = "pdf" class = "btn btn-success" value = "Generate PDF"/>&nbsp &nbsp &nbsp
  </form>
  </div>

</div>


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
