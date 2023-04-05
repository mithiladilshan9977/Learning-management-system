<?php 
include("databaseconn.php");
session_start();
 
require("sessionTime_paperTime.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}else{
   $studentbatch = $_SESSION['STUDENTBATCH'];
   $studentid = $_SESSION['subjectID'];
   $studentID = $_SESSION['studentID'];
}
$questionNumber = $_POST['questionNumber_next'];
$examPaperID = $_SESSION['EXAM_PAPER_ID']  ;

$selectcount = "SELECT MAX(studentGivenAn) as studentGivenAn,questionNumber FROM questionoptions WHERE questionNumber='{$questionNumber}' AND examPaperID='{$examPaperID}' AND studentID='$studentID' ";
$selectcount_run = mysqli_query($conn, $selectcount);
$resultnew = mysqli_fetch_assoc($selectcount_run);

if($resultnew['studentGivenAn'] == 1)
{
    ?>
   <img src="../images/greenQIcon.png" style="" alt="" srcset="" class="greeniconindicater">

    <?php
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
</head>
<style>
    .greeniconindicater{
      width: 12px;
       height: 12px;
        position: relative; 
         border: 2xp solid white;
          margin-left: 9px;
    }
</style>
<body>
   
  
</body>
</html>
