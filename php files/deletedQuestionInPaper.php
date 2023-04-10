<?php 

include("databaseconn.php");
session_start();
error_reporting(0);
require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
  $lecID = $_SESSION['lectureID'];
  $batchID = $_SESSION['batchID_new'];
  $subjectID = $_SESSION['subjectID_new'];
 
}

if(isset($_SESSION['EXAM_PAPER_ID'])){
  $examID = $_SESSION['EXAM_PAPER_ID'];
  
  
}


$questioNumber = $_POST['updateQuestionHolder_next'] ; 
$deleteSQL = "UPDATE question SET deleteornot='1' WHERE lectureID='$lecID' AND questionNumber='$questioNumber' AND examPaperID='$examID'";
$deleteSQL_run = mysqli_query($conn ,$deleteSQL);

if($deleteSQL_run){

    echo ' <div class="alert alert-danger" role="alert">
     Question is deleted
</div>';

    echo '<script> 
    setTimeout(goback , 2000);
    function goback(){ window.location.href="addExamPpaer.php";};
    </script>';
}else{
    echo "<span class=''>Error</span>" ; 
    echo '<script> 
    setTimeout(goback , 2000);
    function goback(){ window.location.href="addExamPpaer.php";};
    </script>';

}






?>