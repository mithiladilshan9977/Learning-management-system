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
 
//upload by excel or not
$updalodbyornotSQL = "SELECT * FROM question where lectureID='{$lecID}' AND examPaperID='$examID' AND deleteornot='0'";
$updalodbyornotSQL_run = mysqli_query($conn ,$updalodbyornotSQL);
$updalodbyornotSQLUpload = mysqli_fetch_assoc($updalodbyornotSQL_run);


///import from excel file
$importExcelKey = 'qkrjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';


function encryptthisExcel($data, $importExcelKey) {
$encryption_key = base64_decode($importExcelKey);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}


function decryptthisExcel($data, $importExcelKey) {
$encryption_key = base64_decode($importExcelKey);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}




    //manually added data encription

    $manualyKey = 'ekwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

 
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

$questioNumber = $_POST['updateQuestionHolder_next'];
$questionText = $_POST['updatingQuestion_nect'];





if($updalodbyornotSQLUpload['uploadByExcelOrnot'] == 1)
{
  $encryptedQuestionText = encryptthismanual($questionText , $manualyKey) ; 
  $updatequestion = "UPDATE question SET questionText='$encryptedQuestionText' WHERE questionNumber='$questioNumber' AND lectureID='$lecID'";
  $updatequestion_run = mysqli_query($conn ,$updatequestion );
  if($updatequestion_run){
    echo "<span class='doneMEssage'>Question is updated</span>" ; 
    echo '<script> 
    setTimeout(goback , 2000);
    function goback(){ window.location.href="addExamPpaer.php";};
    </script>';

}else{
    echo "Error";
 
    echo '<script> 
    setTimeout(goback , 2000);
    function goback(){ window.location.href="addExamPpaer.php";};
    </script>';

}

}else{
  $encryptedQuestionTextExcel = encryptthisExcel($questionText , $importExcelKey) ; 
  $updatequestionexcel = "UPDATE question SET questionText='$encryptedQuestionTextExcel' WHERE questionNumber='$questioNumber' AND lectureID='$lecID'";
  $updatequestionexcel_excel = mysqli_query($conn ,$updatequestionexcel );

  if($updatequestionexcel_excel){
    echo "<span class='doneMEssage'>Question is updated</span>" ; 
    echo '<script> 
    setTimeout(goback , 2000);
    function goback(){ window.location.href="addExamPpaer.php";};
    </script>';

}else{
    echo "Error";
 
    echo '<script> 
    setTimeout(goback , 2000);
    function goback(){ window.location.href="addExamPpaer.php";};
    </script>';

}

}






?>