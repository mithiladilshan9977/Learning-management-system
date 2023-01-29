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

if($studentGivenAnswer == 'undefined'){
    echo "<small class='bad'>Select an answer<small>";
    exit();
}
else{
    $sqlectQuestion = "SELECT * FROM questionoptions WHERE optionID='{$studentGivenAnswer}'";
    $sqlectQuestion_run = mysqli_query($conn, $sqlectQuestion);
    $getdat = mysqli_fetch_assoc($sqlectQuestion_run);
    $isCorrect = $getdat['is_correct'];
    $studentGivenAnnew = $getdat['studentGivenAn'];
     
    
        $updatetheSlected = "UPDATE questionoptions SET studentGivenAn=1 WHERE optionID='{$studentGivenAnswer}'";
        $updatetheSlected_run = mysqli_query($conn, $updatetheSlected);
        if($updatetheSlected_run){
            echo "<small class='good'>done<small>";
        }else{
            echo "<small class='bad'>error<small>";
        }
        $statringOptionNumber = 1;
       
        $selectOptions = "SELECT * FROM questionoptions WHERE questionNumber='{$questionNumber}'";
        $selectOptions_run = mysqli_query($conn, $selectOptions);
        $numberOfRows = mysqli_num_rows($selectOptions_run);
        for( $statringOptionNumber ;  $statringOptionNumber<=$numberOfRows;$statringOptionNumber++ ) {
            
            $forloop = "UPDATE questionoptions SET studentGivenAn=0 WHERE questionNumber='{$questionNumber}'";
            $forloop_run = mysqli_query($conn, $forloop);
        }
        $updatetheSlected = "UPDATE questionoptions SET studentGivenAn=1 WHERE optionID='{$studentGivenAnswer}'";
        $updatetheSlected_run = mysqli_query($conn, $updatetheSlected);
        
     if($isCorrect == 1 && $studentGivenAnnew== 1 ){
        $_SESSION['STUDENT_GIVEN_ANSWERS']++;
     } 
}



  
    
 


?>