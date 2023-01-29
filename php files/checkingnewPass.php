<?php 
include("databaseconn.php");
session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
 header("location:../index.php");
}else{
      $studentID = $_SESSION['studentID'];
}
$newPass =   mysqli_real_escape_string($conn , $_POST['newPass'])  ;
$newPassAgain =  mysqli_real_escape_string($conn ,$_POST['newPassAgain'] )  ;


if(strlen($newPassAgain) <=4){
   echo "<small class='bad'>Password too short</small>";
}
 else if($newPassAgain !==$newPass){
    echo "<small class='bad'>Passwords Not Mataching</small>";
 }else{
    echo "<small class='good'>Passwords  Matched</small>";
 }


?>