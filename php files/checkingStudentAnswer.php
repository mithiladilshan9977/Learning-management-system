<?php 


include("databaseconn.php");
session_start();
require("sessionTime.php");

if (!isset($_SESSION['studentID'])) {
    header("location:../index.php");
    die();
}
 
if(!isset($_SESSION['STUDENT_GIVEN_ANSWERS'])){
      $_SESSION['STUDENT_GIVEN_ANSWERS'] = 0;
} 
$studentGivenAnswer = $_POST['studentGivenAnswer'];
$questionNumber = $_SESSION['QESTIONNUMBER'];
$studentdID = $_SESSION['studentID'];
 


if($studentGivenAnswer == 'undefined'){
    // echo "<small class='bad'>Select an answer<small>";
    exit();
}
else{
    $sqlectQuestion = "SELECT * FROM questionoptions WHERE optionID='{$studentGivenAnswer}' AND studentID='{$studentdID}'";
    $sqlectQuestion_run = mysqli_query($conn, $sqlectQuestion);
    // $isCorrect = $getdat['is_correct'];
    // $studentGivenAnnew = $getdat['studentGivenAn'];
     
    
        $updatetheSlected = "UPDATE questionoptions SET studentGivenAn=1 WHERE optionID='{$studentGivenAnswer}' AND studentID='{$studentdID}'";
        $updatetheSlected_run = mysqli_query($conn, $updatetheSlected);
        if($updatetheSlected_run){
     
                  echo "<small class='good'>Submitted<small>";

                   

        }else{
            echo "<small class='bad'>error<small>";
        }
  
        
        $statringOptionNumber = 1;
    $getdat = mysqli_fetch_assoc($sqlectQuestion_run);

    $questionNumber = $getdat['questionNumber'];
        $selectOptions = "SELECT * FROM questionoptions WHERE questionNumber='{$questionNumber}'AND studentID='{$studentdID}' AND questionNumber='{$questionNumber}'";
        $selectOptions_run = mysqli_query($conn, $selectOptions);
        $numberOfRows = mysqli_num_rows($selectOptions_run);
        for( $statringOptionNumber ;  $statringOptionNumber<=$numberOfRows;$statringOptionNumber++ ) {
            
            $forloop = "UPDATE questionoptions SET studentGivenAn=0 WHERE questionNumber='{$questionNumber}'AND studentID='{$studentdID}' AND questionNumber='{$questionNumber}'";
            $forloop_run = mysqli_query($conn, $forloop);
        }
        $updatetheSlected = "UPDATE questionoptions SET studentGivenAn=1 WHERE optionID='{$studentGivenAnswer}'AND studentID='{$studentdID}' AND questionNumber='{$questionNumber}'";
        $updatetheSlected_run = mysqli_query($conn, $updatetheSlected);

     
     if($getdat['is_correct'] == 1 && $getdat['studentGivenAn']== 1 ){
                  

        $getFullMarks = "SELECT * FROM questionoptions WHERE is_correct=1 AND studentGivenAn=1 AND studentID='$studentdID'";
        $getFullMarks_run = mysqli_query($conn, $getFullMarks);
           $_SESSION['STUDENT_GIVEN_ANSWERS'] = mysqli_num_rows($getFullMarks_run);
     
     
            //   $_SESSION['STUDENT_GIVEN_ANSWERS'] + 1;
        
     } 
}



  
    
 


?>