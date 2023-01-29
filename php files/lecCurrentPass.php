<?php 


include("databaseconn.php");
session_start();
  // require("lectetrSESSION.php");

if (!isset($_SESSION['lectureID'])) {
    header("location:../index.php");
    die();

}
else{
    $lecPass = $_SESSION['lectureID'];
}


$typedPass = $_POST['currentPass'];

$selectLecPass = "SELECT * FROM lecture WHERE lectureID='$lecPass'";
$selectLecPass_run = mysqli_query($conn, $selectLecPass);
$getdata = mysqli_fetch_assoc($selectLecPass_run);
$currentPass = $getdata['password'];

if($currentPass !==$typedPass)
{
    echo "<small class='bad'>Not matching</small>";
}else{
    echo "<small class='good'>Matched</small>";
}



?>