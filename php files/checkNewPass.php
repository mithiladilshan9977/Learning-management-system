<?php

include("databaseconn.php");
session_start();
  // require("lectetrSESSION.php");

if (!isset($_SESSION['lectureID'])) {
    header("location:../index.php");
    die();

}


  $newPass = $_POST['newPass'];
  $newpPassAgain = $_POST['newpPassAgain'];


if(strlen($newpPassAgain) <=4){
    echo "<small class='bad'>Password is too short</small>";
}
else if($newpPassAgain !==$newPass){
    echo "<small class='bad'>Passwords not matching</small>";
}else{
    echo "<small class='good'>Matched</small>";
}







?>