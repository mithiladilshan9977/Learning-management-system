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
$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

//ENCRYPT FUNCTION
function encryptthis($data, $key) {
    $encryption_key = base64_decode($key);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
    }
    
    //DECRYPT FUNCTION
    function decryptthis($data, $key) {
    $encryption_key = base64_decode($key);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

$questioNumber = $_POST['updateQuestionHolder_next'];
$questionText = $_POST['updatingQuestion_nect'];
$encryptedQuestionText = encryptthis($questionText , $key) ; 


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



?>