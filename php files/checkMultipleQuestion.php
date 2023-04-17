<?php 

include("databaseconn.php");
session_start();
 error_reporting(0);
require("sessionTime_paperTime.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}else{
   $studentbatch = $_SESSION['STUDENTBATCH'];
   $studentid = $_SESSION['subjectID'];
   $studentID = $_SESSION['studentID'];
}
             $examPaperID = $_SESSION['EXAM_PAPER_ID'] ; 
             $questione_number = $_POST['questionNumber_next']  ;
             $option_id = $_POST['optionID_next'];

           


  $updatetheSlected = "UPDATE questionoptions SET studentGivenAn=1 WHERE optionID='{$option_id}' AND studentID='{$studentID}' AND questionNumber='{$questione_number}'";
  $updatetheSlected_run = mysqli_query($conn, $updatetheSlected);

  if($updatetheSlected_run){
    echo "<small class='good'>Submitted<small>";
  }
else{
    echo "<small class='bad'>error<small>";

}
?>