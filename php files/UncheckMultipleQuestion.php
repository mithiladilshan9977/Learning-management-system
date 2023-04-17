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


                 $questione_number_unchecked = $_POST['questionNumber_unckeched_next']  ;
                 $option_id_unckecked = $_POST['optionID_unckeched_next'];
   
   
   
                if(!isset($_SESSION['STUDENT_GIVEN_ANSWERS'])){
                   $_SESSION['STUDENT_GIVEN_ANSWERS'] = 0;
               }

      $selectuestion = "SELECT * FROM questionoptions WHERE optionID='{$option_id_unckecked}' AND studentID='{$studentID}' AND questionNumber='{$questione_number_unchecked}'"     ;
      $selectuestion_run = mysqli_query($conn ,  $selectuestion);
      $getdata = mysqli_fetch_assoc($selectuestion_run);
      if($getdata['studentGivenAn'] == '1'){

        $updatetheSlected = "UPDATE questionoptions SET studentGivenAn=0 WHERE optionID='{$option_id_unckecked}' AND studentID='{$studentID}' AND questionNumber='{$questione_number_unchecked}'";
        $updatetheSlected_run = mysqli_query($conn, $updatetheSlected);

        if($updatetheSlected_run){
            echo "<small class='good'>Removed<small>";
          }
        else{
            echo "<small class='bad'>error<small>";
        
        }


      }
      

?>