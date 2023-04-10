


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
</head>
<style>
     

</style>
<body>
<script src="finalpassword.js"></script>
<script src="detectTabnew.js"></script>
 
<!-- <script src="gobackwords.js"></script> -->
 
<script src="vertical_question_form_replace.js"></script>
     
</body>
</html>


<?php 

include("databaseconn.php");
session_start();
 error_reporting(0);
require("sessionTime_paperTime.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}else{
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



     
 $questioNu = $_POST['questionnumber_next'];
 $counter = $_POST['counterval_next'];

 $examPaperID = $_SESSION['EXAM_PAPER_ID'];

 $selectquesry = "SELECT * FROM question where studentID='{$studentID}' AND examPaperID='$examPaperID' ";
$selectquesry_run = mysqli_query($conn ,$selectquesry);
$getSelectdata = mysqli_fetch_assoc($selectquesry_run);



 $selectNotChangeQuestion = "SELECT * FROM questionselected WHERE examPaperID='$examPaperID' AND studentID='$studentID' AND questionNumber='$questioNu' LIMIT 1";
 $selectNotChangeQuestion_run = mysqli_query($conn , $selectNotChangeQuestion);

?>

<?php 
 
 

 
while($rows = mysqli_fetch_assoc($selectNotChangeQuestion_run))
{  
     
    

     ?>
       <div class="container  whatisquestionbox" >
          
        <p class="whatisquestionCSS"></b><?php echo $counter.' ) ';?> <?php 
        
        if($getSelectdata['uploadByExcelOrnot'] == 1){
         echo decryptthismanual($rows['questionText'],$manualyKey);  
         
         }else{
           echo decryptthisExcel($rows['questionText'],$importExcelKey);  
         
         }

        
        
        ?> </b></p>
</div>



        
         <div class="container optionsBox">
         <?php    
        
         
         $quesnumbr = $rows['questionNumber'] ; 
                   
        $selectoptions_randowm = "SELECT * FROM questionoptions WHERE questionNumber='$quesnumbr' AND  examPaperID='$examPaperID' AND studentID='$studentID' ORDER BY RAND() ";
        $selectoptions_random_run = mysqli_query($conn, $selectoptions_randowm);

        while($options = mysqli_fetch_assoc($selectoptions_random_run ))
        {
         ?>
        <p>   <input type='text'  class="quesnumberValue" value=<?php echo $options['questionNumber']?>>  <input type="radio" id="theradiobutton"  name="<?php echo $options['questionNumber']?>"   <?php if ($options['studentGivenAn'] == 1) {
            echo 'checked'; }?> class="my-1 studentAnswer" value="<?php echo $options['optionID'];?>"  style="cursor: pointer;">  <?php
            
            if($getSelectdata['uploadByExcelOrnot'] == 1){
               echo  decryptthismanual($options['options'],$manualyKey);     
             }else{
               echo decryptthisExcel($options['options'],$importExcelKey);     
           
             }            
            
            ?> </p>
   

<?php
        }
        
        ?>
         <span class="responseshow">  </span>
      </div>
   
<?php
 
}

?>


