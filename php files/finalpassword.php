<?php 

include("databaseconn.php");
session_start();
error_reporting(0);
// require("lectetrSESSION.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}else{
   $studentbatch = $_SESSION['STUDENTBATCH'];
   $studentid = $_SESSION['subjectID'];
    $examid = $_SESSION['EXAM_PAPER_ID'];
    $realstudentID =$_SESSION['studentID'];

 
}
if(!isset($_SESSION['STUDENT_GIVEN_ANSWERS'])){
  $_SESSION['STUDENT_GIVEN_ANSWERS'] = 0;
}

  $password = $_POST['thepassword'];

$selectExam = "SELECT * FROM examinformation WHERE examPaperID='{$examid}'";
$selectExam_run = mysqli_query($conn, $selectExam);
$getdata = mysqli_fetch_assoc($selectExam_run);
$passowrdSaved = $getdata['password'];
$subjectName = $getdata['paperName'];

$selectQuestionnew = "SELECT * FROM question WHERE examPaperID='$examid' AND studentID='$realstudentID'";
$selectQuestionnew_run = mysqli_query($conn, $selectQuestionnew);
    $allQuestions = $_SESSION['NUMBER_OF_QUESTIONS'];
 


//getting students marks in %



if($password !==$passowrdSaved)
{
    echo '<div class="alert alert-danger" role="alert">
   Password is not correct
  </div>';
  die();
}
else{
  $numberofCorrectAnswers =  $_SESSION['STUDENT_GIVEN_ANSWERS'];
  $thFinelMarks = round(($numberofCorrectAnswers / $allQuestions) * 100) ;
   
  
  $InsertMarks = "INSERT INTO studentExamMarks (studentID , SubjectName, SubjectMarks) VALUES ('$realstudentID' , '$subjectName','$thFinelMarks' )";
  $InsertMarks_run = mysqli_query($conn , $InsertMarks);
  if($InsertMarks_run){
    echo "<script> window.location.href='endOfPaper.php?examPaperID=<?php echo  $examid?>'</script>";

  }

}

 
  
{ 
    
}


?>