<?php

include("databaseconn.php");
session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
 header("location:../index.php");
}else{
      $studentID = $_SESSION['studentID'];
}
$currentPass = $_POST['thecurrentPass'];
$selectsql = "SELECT * FROM student WHERE studentID='$studentID'";
$selectsql_run = mysqli_query($conn , $selectsql);
$getPass = mysqli_fetch_assoc($selectsql_run);
  $password = $getPass['password'];


if($currentPass !== $password ){
    echo "<small class='bad'>Not matched</small>";
}else{
    echo "<small class='good'>Matched</small>";
}




?>