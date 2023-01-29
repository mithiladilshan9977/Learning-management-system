<?php 
include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}else{
    $studentid = $_SESSION['studentID'];
   $studentbatch = $_SESSION['STUDENTBATCH'];
   $subjectID = $_SESSION['subjectID'];
   $examID = $_SESSION['EXAM_PAPER_ID'];
}
  $newdata = $_POST['newdata'];
if($newdata =='visible'){

    $insertmistakes = "INSERT INTO detectexam(studentID,examid,subjectid,batchid) values('{$studentid}','{$examID}','{$subjectID}','{$studentbatch}')";
    $insertmistakes_run = mysqli_query($conn, $insertmistakes);

    if($insertmistakes_run ==true){
        echo "<small class='hswotheerror'>You are trying to do something</small>";
    }

} 
?>