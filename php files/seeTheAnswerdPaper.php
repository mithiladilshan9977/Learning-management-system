<?php


include("databaseconn.php");
session_start();
 
require("sessionTime_paperTime.php");

if (!isset($_SESSION['studentID'])) {
    header("location:../index.php");
    die();
} else {
    $studentbatch = $_SESSION['STUDENTBATCH'];
    $studentid = $_SESSION['subjectID'];
    $studentID = $_SESSION['studentID'];
}

  $examPaperID = $_SESSION['EXAM_PAPER_ID'] ;




$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

//ENCRYPT FUNCTION
function encryptthis($data, $key)
{
    $encryption_key = base64_decode($key);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

//DECRYPT FUNCTION
function decryptthis($data, $key)
{
    $encryption_key = base64_decode($key);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

function decryptthissone($data, $newkey)
{
    $encryption_key = base64_decode($newkey);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}



 
 

 
//get 1 scored question from options
$select_answer_1 = "SELECT * FROM  questionoptions WHERE examPaperID = '$examPaperID' AND studentID = '$studentID'  AND studentGivenAn = 1";
$select_answer_1_run = mysqli_query($conn, $select_answer_1);
 

 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check answers</title>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <?php include("boostrap.php")?>
</head>
<style>
    .mainholder{
  
        margin-top: 25px;
        padding: 15px
        border: 1px solid rgba(0, 0, 0, 0.564) ;
    }
    .whatisquestion{
        background-color:rgba(0, 204, 255, 0.286);
      border-radius: 10px;
      padding: 13px;
      margin: 7px 0px 0px 1px;
      font-size: 20px;
  
    }
    .optiontext{
  
      margin-left: 20px;
        padding: 15px;
 
   
    }
</style>
<body>
<?php include("innerpreloader.php");?>

<?php include("student_header.php")  ?>






<div class="container mainholder" style="width:60%" >

  <?php 
  $counter = 1; 
while($dater  = mysqli_fetch_assoc($select_answer_1_run)){

     $question_with_1 = $dater['questionNumber'] . "<br>";

  $slect_1_questions = "SELECT * FROM question WHERE examPaperID='$examPaperID' AND studentID='$studentID'   AND questionNumber='$question_with_1'";
  $slect_1_questions_run = mysqli_query($conn, $slect_1_questions);
  $getqutiondata = mysqli_fetch_assoc($slect_1_questions_run);
    $numberOfQuestions =  mysqli_num_rows($slect_1_questions_run);
    $quesNumber = $getqutiondata['questionNumber'];
 
 
  echo  '<h5 class="whatisquestion">'. $counter. ' ) '  .  decryptthis($getqutiondata['questionText'], $key) . '<br>' . '</h5>';
  
 

  $optionsql = "SELECT * FROM  questionoptions WHERE examPaperID = '$examPaperID' AND studentID = '$studentID'  AND questionNumber = '$quesNumber'";
   $optionsql_run = mysqli_query($conn, $optionsql);

   while($datanew = mysqli_fetch_assoc($optionsql_run) )
   {
    if($datanew['is_correct'] == 1)
    {
     echo '<span class="optiontext">'.'<u>'.decryptthis($datanew['options'], $key ).'</u>'.'</span>';
          if($datanew['studentGivenAn'] == $datanew['is_correct'])
          {?>

<img src = "../images/answeiscorrect.png" style="width:15px ; height:15px"/>

<?php
             
          } 
     echo  '<br>' ; 
     continue;

    }
     echo '<span class="optiontext">'.decryptthis($datanew['options'], $key ).'</span>' ;

     if($datanew['studentGivenAn'] == $datanew['is_correct']){
 
      }else
      {?>
           <img src = "../images/wronganser.png" style="width:15px ; height:15px"/>

      <?php
 
      }

     echo '<br>' ;

   }

   $counter ++ ;  

}

   
  ?>
   </div>

</body>
</html>
