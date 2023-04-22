<?php 

include("databaseconn.php");
session_start();
// error_reporting(0);
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


  $password = $_POST['thepassword'];
  $_SESSION['EXAM_END_TIME'] = $_POST['endtime'];


$selectExam = "SELECT * FROM examinformation WHERE examPaperID='{$examid}'";
$selectExam_run = mysqli_query($conn, $selectExam);
$getdata = mysqli_fetch_assoc($selectExam_run);
$passowrdSaved = $getdata['password'];
$subjectName = $getdata['paperName'];

 
//getting students marks in %

if($password !==$passowrdSaved){
  echo '<div class="alert alert-danger" role="alert">
  Password is not correct
 </div>';
 die();
}else
{
?>
 <script> window.location.href='endOfPaper.php?examPaperID=<?php echo  $examid ;?> && subjectName=<?php echo  $subjectName ;?>'</script>";

<?php
  

}
 


?>