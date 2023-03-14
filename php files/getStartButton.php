<?php 
include("databaseconn.php");
session_start();
error_reporting();
 
// require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
    $lecID = $_SESSION['lectureID'];
    $batchID = $_SESSION['batchID_new'];
    $subjectID = $_SESSION['subjectID_new'];
  
  }

  $selectpaper = "SELECT * FROM examinformation WHERE batchID='{$batchID}' AND lecturID='{$lecID}' and subjectID='{$subjectID}'  ";
  $selectpaper_run = mysqli_query($conn, $selectpaper);
  $getdata = mysqli_fetch_assoc($selectpaper_run);
  
    if($getdata['status'] == 1)
    {        
           echo ' <button type="button" class="btn btn-dark"   id="NowstartExamBTtn">Start</button>';
    } 
 
    
 
  

 


?>

<script src="startTheExamNow.js"></script>  