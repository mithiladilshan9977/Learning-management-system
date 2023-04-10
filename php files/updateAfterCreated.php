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


$questioNumber = $_POST['questionnumber_next'];


$selectquesry = "SELECT  *  FROM question where questionNumber='$questioNumber' AND examPaperID='$examID' AND lectureID='$lecID'";
$selectquesry_run = mysqli_query($conn ,$selectquesry);
$getSelectdata = mysqli_fetch_assoc($selectquesry_run);

$questionNumberFindOptions =  $getSelectdata['questionNumber'];
 

?>
 <p class="updateQuestionHolder"> 
    
      <button class="btn btn-dark updatingQuestionGiven">Update question</button> 
      <span class="showthequestionupdayedmsg"></span>
      <input type="hidden" class="questioNumberToUpdate" value="<?php echo $questioNumber ; ?>">
        <input type="text" class="form-control my-3 updatingQuestion" value="<?php echo decryptthis($getSelectdata['questionText'] , $key)?>" >         
          </p>

 
<?php


$selectoptions_randowm = "SELECT  studentID,options,optionID  FROM questionoptions WHERE questionNumber='$questionNumberFindOptions' AND  examPaperID='$examID'  LIMIT 5 ";
$selectoptions_random_run = mysqli_query($conn, $selectoptions_randowm);



while($rowdata = mysqli_fetch_assoc($selectoptions_random_run))
{
    ?>
       <p class="updateQuestionHolder">   
        <span class="updateQuestionCheck"></span>
         <button class="btn btn-info  updateThisQuestion"    >Update</button> <input type="hidden" class="optionIDTOUpdate" value="<?php echo $rowdata['optionID'] ; ?>" >   <input type="text" class="form-control   updatetedOption" value="<?php echo decryptthis($rowdata['options'] , $key)?>" style="width:88%">    
           </p>
    <?php
}
?>


<?php

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
  .updatingQuestion{
 font-weight: bold;

  }
  .updateThisQuestion{
    display: inline; 
    float: left;
    margin-right: 10px;
  }
  .updatetedOption{
 
    position: relative;
  }
  .doneMEssage{
    color: rgb(15, 149, 0);
 font-weight: bold;

    margin: 10px;
  }
</style>
<body>
   
    <script type="text/javascript" src="updatetheQuestion.js"></script>
    <script type="text/javascript" src="updateTheGivenQuestion.js"></script>

 
    
</body>
</html>
