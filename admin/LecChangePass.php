<?php
 
include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
  echo "<script>window.location.href = 'index.php'</script>";
  die();
}

$newPass = $_POST['newPass'];
$newPassAgain = $_POST['theAgainPass'];

if(strlen($newPassAgain) <= 4 ){
    echo "<small class='bad'>Password Too Short</small>";
}
else if ($newPassAgain !== $newPass){
    echo "<small class='bad'>Passwords Not Matching</small>";
}else{
    echo "<small class='good'> Matched </small>";
}

?>