<?php


include("databaseconn.php");
session_start();
 error_reporting(0) ; 
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




 
//upload by excel or not
$updalodbyornotSQL = "SELECT * FROM question where studentID='{$studentID}' AND examPaperID='$examPaperID' AND deleteornot='0'";
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


 
 

 
//get 1 scored question from options
$select_answer_1 = "SELECT * FROM  questionoptions WHERE examPaperID = '$examPaperID' AND studentID = '$studentID'  AND studentGivenAn = 1";
$select_answer_1_run = mysqli_query($conn, $select_answer_1);
 

$selectimenew = "SELECT * FROM examinformation WHERE batchID='{$studentbatch}' AND subjectID='{$studentid}'";
$selectime_runnew = mysqli_query($conn, $selectimenew);
$gettinewdatanew = mysqli_fetch_assoc($selectime_runnew);
$examHours = $gettinewdatanew['hoursnew'];
$examMunites = $gettinewdatanew['minutesnew'];
$limiteTo = $gettinewdatanew['limitTo'];
$exampaperName =  $gettinewdatanew['paperName'];
$lecID =  $gettinewdatanew['lecturID'];
$limiteNumber =  $gettinewdatanew['limitTo'];

$selectlectur = "SELECT * FROM lecture WHERE lectureID='{$lecID}'";
$selectlectur_run = mysqli_query($conn , $selectlectur);
$getlecdata = mysqli_fetch_assoc($selectlectur_run);
$Fnamelec =  $getlecdata['firstname'];
$Lnamelec =  $getlecdata['lastname'];
 


$selectquesry = "SELECT * FROM question where studentID='{$studentID}' AND examPaperID='$examPaperID' ";
$selectquesry_run = mysqli_query($conn ,$selectquesry);
$getSelectdata = mysqli_fetch_assoc($selectquesry_run);

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
        padding: 15px;
        border-radius: 15px;
        border: 2px solid rgba(0, 0, 0, 0.822);
        
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
      margin-bottom: 5px;
 
   
    }
    .campImage{
      max-width: 150px;
      min-height: 150px;
      text-align:center;
      margin: 0px auto;
     }
     .inforBox{
      display: flex;
      background-color: rgba(186, 186, 186, 0.208) ;
      flex-direction:   column;
    padding: 15px;
    margin: 10px;
    border-radius:15px;
      align-items: flex-start;

     }
     .printntm{
      margin:10px;
     }
</style>
<body>
<?php include("innerpreloader.php");?>

<?php include("student_header.php")  ?>

<button class="btn btn-success printntm" onclick="window.print()" >Print</button>
 
 






<div class="container mainholder" style="width:60%" >

<div class="modal-header mainheader">
         <img src="../images/camp.png" class="rounded float-start campImage"/>  

         
  </div>

  <div class="modal-header  inforBox">
 <p><b>Conducted By </b>: <?php echo  $Fnamelec .' '.  $Lnamelec?></p>
 <p><b>Subject </b>:  <?php echo  $exampaperName ;?> MCQ paper</p>  
 <p><b>Time </b>: <?php echo  $examHours .'.'. $examMunites  ?> Hours</p> 
 <p>Answer all <?php echo   $limiteNumber ?> questions</p> 



   </div>
   

  <?php 
  $counter = 1; 
while($dater  = mysqli_fetch_assoc($select_answer_1_run)){

     $question_with_1 = $dater['questionNumber'] . "<br>";

  $slect_1_questions = "SELECT * FROM question WHERE examPaperID='$examPaperID' AND studentID='$studentID'   AND questionNumber='$question_with_1'";
  $slect_1_questions_run = mysqli_query($conn, $slect_1_questions);
  $getqutiondata = mysqli_fetch_assoc($slect_1_questions_run);
    $numberOfQuestions =  mysqli_num_rows($slect_1_questions_run);
    $quesNumber = $getqutiondata['questionNumber'];
 
 ?>
         <h5 class="whatisquestion"><?php echo $counter .' ) ';?><?php 
          if($updalodbyornotSQLUpload['uploadByExcelOrnot'] == 1){
            echo decryptthismanual($getqutiondata['questionText'],$manualyKey);  
            
            }else{
              echo decryptthisExcel($getqutiondata['questionText'],$importExcelKey);  
            
            }
         ?></h5>
 <?php
  
  
 

  $optionsql = "SELECT * FROM  questionoptions WHERE examPaperID = '$examPaperID' AND studentID = '$studentID'  AND questionNumber = '$quesNumber'";
   $optionsql_run = mysqli_query($conn, $optionsql);

   while($datanew = mysqli_fetch_assoc($optionsql_run) )
   {
    if($datanew['is_correct'] == 1)
    {
      ?>
                <span class="optiontext"><u>
                  <?php 
                  
                  if($updalodbyornotSQLUpload['uploadByExcelOrnot'] == 1){
                    echo decryptthismanual($datanew['options'],$manualyKey);  
                    
                    }else{
                      echo decryptthisExcel($datanew['options'],$importExcelKey);  
                    
                    }

                  ?>
              
                </u> </span>
      <?php
    
          if($datanew['studentGivenAn'] == $datanew['is_correct'])
          {?>

<img src = "../images/answeiscorrect.png" style="width:15px ; height:15px"/>

<?php
             
          } 
     echo  '<br>' ; 
     continue;

    }
    ?>
       <span class="optiontext">
       <?php 
                  
                  if($updalodbyornotSQLUpload['uploadByExcelOrnot'] == 1){
                    echo decryptthismanual($datanew['options'],$manualyKey);  
                    
                    }else{
                      echo decryptthisExcel($datanew['options'],$importExcelKey);  
                    
                    }

                  ?>

       </span>
    <?php
     

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
