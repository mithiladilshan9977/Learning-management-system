<?php 

include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
    $lecID = $_SESSION['lectureID'];
    $batchID = $_SESSION['batchID_new'];
    $subjectID = $_SESSION['subjectID_new'];
  
  }

$updateSQL = "UPDATE examinformation SET status='1' WHERE batchID='{$batchID}' AND lecturID='{$lecID}' AND subjectID='{$subjectID}'" ;
$updateSQL_run = mysqli_query($conn, $updateSQL);
  if($updateSQL_run)
  {

    echo '<script>swal("Exam Just Started", "Good Luck") 
  setTimeout(goback , 2000);
  function goback(){ window.location.href="addExamPpaer.php";};
  
  </script>';
 
  }





?>