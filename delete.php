<?php
session_start();
include('db.php');
$t = 0;
$error = 0;
$delete = 'delete from party';
mysqli_query($con, $delete);
$q = 'delete from dis';
$result3 = mysqli_query($con,$q);
header("Location: ./index.php");
?>
