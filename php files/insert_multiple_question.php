<?php

include("databaseconn.php");
session_start();
// error_reporting(0);
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
//getting each studets
$studentIDArray = [];
$sqlselectBatch = "SELECT student.*, batch.* FROM student LEFT JOIN batch ON student.batchID = batch.BatchID WHERE batch.BatchID = '$batchID'";
$sqlselectBatch_run = mysqli_query($conn, $sqlselectBatch);
if  (mysqli_num_rows($sqlselectBatch_run) > 0){
       while($row= mysqli_fetch_array($sqlselectBatch_run)){
    $studentIDArray[] = $row['studentID'];
       }
}

$manualyKey = 'ekwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

//ENCRYPT FUNCTION
function encryptthismanual($data, $manualyKey) {
    $encryption_key = base64_decode($manualyKey);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
    }
    
 
    function decryptthismanual($data, $manualyKey) {
    $encryption_key = base64_decode($manualyKey);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }


  $questioNumber = $_POST['questionNumber_next'];
  $questionText = $_POST['questionText_next'];
  if(empty( $questioNumber ))
  {
    echo '<div class="alert alert-danger role="alert"">
     No question number !
    </div>'; 
  }
  $enciptedQuestionText = encryptthismanual($questionText ,$manualyKey );
  global  $insertQuesSQL_run;
  

$choice = array();


$choice[1] = mysqli_real_escape_string($conn ,  $_POST['choise1_next']) ;
$choice[2] =mysqli_real_escape_string($conn ,  $_POST['choise2_next']) ;
$choice[3] = mysqli_real_escape_string($conn , $_POST['choise3_next']) ;
$choice[4] = mysqli_real_escape_string($conn , $_POST['choise4_next']) ;
$choice[5] = mysqli_real_escape_string($conn , $_POST['choise5_next']) ;

 

foreach($studentIDArray as $StudentIndexNum){
    $StudentIndexNum;
    $insertQuesSQL = "INSERT INTO question(examPaperID,questionNumber,lectureID,studentID,questionText,uploadByExcelOrnot) VALUES ('{$examID}','{$questioNumber}'  ,'{$lecID}','{$StudentIndexNum}','{$enciptedQuestionText}','1')";
    $insertQuesSQL_run = mysqli_query($conn, $insertQuesSQL);

    $updatedQuestionType  = "UPDATE question SET questionType='multiple' WHERE questionNumber='$questioNumber' AND examPaperID='$examID' AND lectureID = '$lecID'";
    $updatedQuestionType_run = mysqli_query($conn, $updatedQuestionType);

}

if(empty($questionText)){
    echo '<div class="alert alert-danger role="alert"">
      Fields are empty !
    </div>'; 
}
else if( $insertQuesSQL_run){
  foreach($studentIDArray as $StudentIndexNum)
  {
    $StudentIndexNum;

    foreach($choice as $option => $value)
    {
        if($value != ""){
            if(strpos($value,"***R")){
                $isCottect = 1;
         
            }else{
                 $isCottect = 0;
                }

        }

        $removeRtext = str_replace("***R", "" ,$value);
        $encyptedValue = encryptthismanual($removeRtext, $manualyKey);
        $insertOptionsSQL = "INSERT INTO questionoptions(examPaperID,questionNumber,lectureID,studentID,options,is_correct) values('{$examID}','{$questioNumber}' , '{$lecID}' ,'{$StudentIndexNum}', '{$encyptedValue}' , '{$isCottect}')";
        $insertOptionsSQL_run = mysqli_query($conn, $insertOptionsSQL);

        if ($insertOptionsSQL_run) {

            continue;
        } else {
            echo die("Error occured !");
        }

    }
  }
}
?>

 