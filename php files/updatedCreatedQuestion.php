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



    //manually uencrpted quetion

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

$optionsID = $_POST['questionnumber_next'];
$questioText = $_POST['updatetedOption_next'] ; 



//checking upload by manually or not
$selectquesry = "SELECT * FROM question where lectureID='{$lecID}' AND examPaperID='$examID' ";
 $selectquesry_run = mysqli_query($conn ,$selectquesry);
 $getSelectdata = mysqli_fetch_assoc($selectquesry_run);

 if($getSelectdata['uploadByExcelOrnot'] == 1)
 {
  $encryptedOption = encryptthismanual($questioText , $manualyKey) ; 
  $updatequestion = "UPDATE questionoptions SET options='$encryptedOption' WHERE optionID='$optionsID' AND lectureID='$lecID'";
  $updatequestion_run = mysqli_query($conn ,$updatequestion );

  if($updatequestion_run ){
    echo "<span class='doneMEssage'>Option is updated</span>" ; 
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
  $encryptedOptionExcel = encryptthisExcel($questioText , $importExcelKey) ; 
  $updatequestionExel = "UPDATE questionoptions SET options='$encryptedOptionExcel' WHERE optionID='$optionsID' AND lectureID='$lecID'";
  $updatequestionexcel_run = mysqli_query($conn ,$updatequestionExel );


  if($updatequestionexcel_run ){
    echo "<span class='doneMEssage'>Option is updated</span>" ; 
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