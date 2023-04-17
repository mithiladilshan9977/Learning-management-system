<?php 

include("databaseconn.php");
session_start();
//  error_reporting(0);
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

           
             if(!isset($_SESSION['STUDENT_GIVEN_ANSWERS'])){
              $_SESSION['STUDENT_GIVEN_ANSWERS'] = 0;
          }

 $bool = false;
  $updatetheSlected = "UPDATE questionoptions SET studentGivenAn=1 WHERE optionID='{$option_id}' AND studentID='{$studentID}' AND questionNumber='{$questione_number}' AND examPaperID='$examPaperID'";
  $updatetheSlected_run = mysqli_query($conn, $updatetheSlected);
     
 
  $selectRightAnswers = "SELECT * FROM questionoptions WHERE  studentID='{$studentID}' AND questionNumber='{$questione_number}' AND examPaperID='$examPaperID' AND is_correct='1' AND studentGivenAn='1'";
  $selectRightAnswers_run = mysqli_query($conn ,  $selectRightAnswers);
 
  //compating num of rows
  $selectRightAnswers_rows = "SELECT * FROM questionoptions WHERE  studentID='{$studentID}' AND questionNumber='{$questione_number}' AND examPaperID='$examPaperID' AND is_correct='1'  ";
  $selectRightAnswers_rows_run = mysqli_query($conn ,  $selectRightAnswers_rows);

  //number of gicen answers
  $selectRightAnswers_given = "SELECT * FROM questionoptions WHERE  studentID='{$studentID}' AND questionNumber='{$questione_number}' AND examPaperID='$examPaperID' AND  studentGivenAn='1'  ";
  $selectRightAnswers_given_run = mysqli_query($conn ,  $selectRightAnswers_given);
 
 
if(  mysqli_num_rows($selectRightAnswers_given_run) >  mysqli_num_rows($selectRightAnswers_rows_run)) {
       
        echo $_SESSION['STUDENT_GIVEN_ANSWERS']   ;
  
} else if (mysqli_num_rows($selectRightAnswers_run) == mysqli_num_rows($selectRightAnswers_rows_run))
{
  echo $_SESSION['STUDENT_GIVEN_ANSWERS'] ++   ;
}else{
  echo $_SESSION['STUDENT_GIVEN_ANSWERS']  ;
}

  if($updatetheSlected_run){
    echo "<small class='good'>Submitted<small>";
  }
else{
    echo "<small class='bad'>error<small>";

}
?>