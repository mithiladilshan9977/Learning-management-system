<?php
include("databaseconn.php");
session_start();
// error_reporting(0);
// require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}
else{
    $lecID = $_SESSION['lectureID'];
    $examPaperID = $_SESSION['EXAM_PAPER_ID'];
    $batchID = $_SESSION['batchID_new'];



}

$manualyKey = 'ekwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

//ENCRYPT FUNCTION
function encryptthis($data, $manualyKey) {
    $encryption_key = base64_decode($manualyKey);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
    }
    
    //DECRYPT FUNCTION
    function decryptthis($data, $manualyKey) {
    $encryption_key = base64_decode($manualyKey);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

    
    $studentIDArray = [];
    $sqlselectBatch = "SELECT student.*, batch.* FROM student LEFT JOIN batch ON student.batchID = batch.BatchID WHERE batch.BatchID = '$batchID'";
    $sqlselectBatch_run = mysqli_query($conn, $sqlselectBatch);
if  (mysqli_num_rows($sqlselectBatch_run) > 0){
           while($row= mysqli_fetch_array($sqlselectBatch_run)){
        $studentIDArray[] = $row['studentID'];
           }
}

 


global $insertQuesSQL_run;
    

$questionnumber =mysqli_real_escape_string($conn ,$_POST['questionnumber'] )  ;
$whatisQuestion = mysqli_real_escape_string($conn , $_POST['whatisQuestion']) ;
$correctNumber = mysqli_real_escape_string($conn , $_POST['correctNumber']) ;

$encryptedWhatIsQuestion = encryptthis($whatisQuestion, $manualyKey);

$choice = array();
 

  $choice[1] = mysqli_real_escape_string($conn ,  $_POST['choice1']) ;
  $choice[2] =mysqli_real_escape_string($conn ,  $_POST['choice2']) ;
  $choice[3] = mysqli_real_escape_string($conn , $_POST['choice3']) ;
  $choice[4] = mysqli_real_escape_string($conn , $_POST['choice4']) ;
  $choice[5] = mysqli_real_escape_string($conn , $_POST['choice5']) ;

foreach($studentIDArray as $StudentIndexNum){
    $StudentIndexNum;
    $insertQuesSQL = "INSERT INTO question(examPaperID,questionNumber,lectureID,studentID,questionText,uploadByExcelOrnot) VALUES ('{$examPaperID}','{$questionnumber}'  ,'{$lecID}','{$StudentIndexNum}','{$encryptedWhatIsQuestion}','1')";
    $insertQuesSQL_run = mysqli_query($conn, $insertQuesSQL);

    $updatedQuestionType  = "UPDATE question SET questionType='single' WHERE questionNumber='$questionnumber' AND examPaperID='$examPaperID' AND lectureID = '$lecID'";
    $updatedQuestionType_run = mysqli_query($conn, $updatedQuestionType);
}


 if(empty($whatisQuestion) || empty($correctNumber)){
    echo '<div class="alert alert-danger role="alert"">
      Fields are empty !
    </div>'; 
 } else if ($insertQuesSQL_run) {
    foreach ($studentIDArray as $StudentIndexNum) {
        $StudentIndexNum;

        foreach ($choice as $option => $value) {
            if ($value != "") {
                if ($correctNumber == $option) {
                    $isCottect = 1;
                } else {
                    $isCottect = 0;
                }

                $encyptedValue = encryptthis($value, $manualyKey);
                $insertOptionsSQL = "INSERT INTO questionoptions(examPaperID,questionNumber,lectureID,studentID,options,is_correct) values('{$examPaperID}','{$questionnumber}' , '{$lecID}' ,'{$StudentIndexNum}', '{$encyptedValue}' , '{$isCottect}')";
                $insertOptionsSQL_run = mysqli_query($conn, $insertOptionsSQL);

                if ($insertOptionsSQL_run) {

                    continue;
                } else {
                    echo die("Error occured !");
                }

            }
        }
    }
} else{
    echo "not inserted";
}
?>