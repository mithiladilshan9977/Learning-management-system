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

  $questione_number = $_POST['questionNumber_next']  ;
  $option_id = $_POST['optionID_next'];

  if(!isset($_SESSION['STUDENT_GIVEN_ANSWERS'])){
    $_SESSION['STUDENT_GIVEN_ANSWERS'] = 0;
}

  $sqlectQuestion = "SELECT MAX(studentGivenAn) as studentGivenAn FROM questionoptions WHERE     studentID='{$studentID}' AND questionNumber='{$questione_number}'";
  $sqlectQuestion_run = mysqli_query($conn, $sqlectQuestion);
  $getdata = mysqli_fetch_assoc($sqlectQuestion_run);
  $anser_given_or_not =  $getdata['studentGivenAn'];
  if($anser_given_or_not  == 0){

    $updatetheSlected = "UPDATE questionoptions SET studentGivenAn=1 WHERE optionID='{$option_id}' AND studentID='{$studentID}' AND questionNumber='{$questione_number}'";
    $updatetheSlected_run = mysqli_query($conn, $updatetheSlected);
 

    if($updatetheSlected_run){
       
      $getFullMarks = "SELECT * FROM questionoptions WHERE is_correct=1 AND studentGivenAn=1 AND studentID='$studentID'";
      $getFullMarks_run = mysqli_query($conn, $getFullMarks);
      $getdatanew = mysqli_fetch_assoc($getFullMarks_run);
 if(isset($getdatanew )){
  if($getdatanew['is_correct'] == 1 && $getdatanew['studentGivenAn']== 1 ){
   
       $_SESSION['STUDENT_GIVEN_ANSWERS'] = mysqli_num_rows($getFullMarks_run);
    
} else{
 
}
 }
      
      echo "<small class='good'>Submitted<small>";

        }else{

        echo "<small class='bad'>error<small>";

        }
  }else{
    
    $statringOptionNumber = 1;
 

 

        $selectOptions = "SELECT * FROM questionoptions WHERE questionNumber='{$questione_number}'AND studentID='{$studentID}'  ";
        $selectOptions_run = mysqli_query($conn, $selectOptions);
      
        $numberOfRows = mysqli_num_rows($selectOptions_run);
        
        for( $statringOptionNumber ;  $statringOptionNumber<=$numberOfRows;$statringOptionNumber++ ) {
            
            $forloop = "UPDATE questionoptions SET studentGivenAn=0 WHERE questionNumber='{$questione_number}'AND studentID='{$studentID}'  ";
            $forloop_run = mysqli_query($conn, $forloop);
        }
        $updatetheSlected_update = "UPDATE questionoptions SET studentGivenAn=1 WHERE optionID='{$option_id}'AND studentID='{$studentID}'  ";
        $updatetheSlected_run_update = mysqli_query($conn, $updatetheSlected_update);
        if($updatetheSlected_run_update){
       

          $getFullMarks = "SELECT * FROM questionoptions WHERE is_correct=1 AND studentGivenAn=1 AND studentID='$studentID'";
          $getFullMarks_run = mysqli_query($conn, $getFullMarks);
          $getdatanew = mysqli_fetch_assoc($getFullMarks_run);
          if(isset($getdatanew)){
            if($getdatanew['is_correct'] == 1 && $getdatanew['studentGivenAn']== 1 ){
       
                 $_SESSION['STUDENT_GIVEN_ANSWERS'] = mysqli_num_rows($getFullMarks_run);
              
          } else{
         
          }
          }
          



            echo "<small class='good'>Re-submitted<small>";
      
              }else{
      
              echo "<small class='bad'>error<small>";
      
              }

              

              

  }


 

?>