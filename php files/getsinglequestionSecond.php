<?php 

include("databaseconn.php");
session_start();
 
require("sessionTime_paperTime.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}else{
   $studentbatch = $_SESSION['STUDENTBATCH'];
   $studentid = $_SESSION['subjectID'];
   $studentID = $_SESSION['studentID'];
}
$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
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

    function decryptthissone($data, $newkey) {
     $encryption_key = base64_decode($newkey);
     list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
     return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
     }


     
 $questioNu = $_POST['questionnumber_next'];
 $examPaperID = $_SESSION['EXAM_PAPER_ID'];

 $selectquesry = "SELECT * FROM question where studentID='{$studentID}' AND examPaperID='$examPaperID' ";
$selectquesry_run = mysqli_query($conn ,$selectquesry);
$getSelectdata = mysqli_fetch_assoc($selectquesry_run);



 $selectNotChangeQuestion = "SELECT * FROM questionselected WHERE examPaperID='$examPaperID' AND studentID='$studentID' AND questionNumber='$questioNu' LIMIT 1";
 $selectNotChangeQuestion_run = mysqli_query($conn , $selectNotChangeQuestion);

?>

<?php 
 
 

$counter = 1;
while($rows = mysqli_fetch_assoc($selectNotChangeQuestion_run))
{  
     
    

     ?>
       <div class="container  whatisquestionbox" >
          
        <p class="whatisquestionCSS"></b><?php echo $counter.' ) ';?> <?php 
        
        if($getSelectdata['uploadByExcelOrnot'] == 1){
         echo decryptthis($rows['questionText'],$key);  
         
         }else{
           echo decryptthissone($rows['questionText'],$newkey);  
         
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
               echo  decryptthis($options['options'],$key);     
             }else{
               echo decryptthis($options['options'],$keyee);     
           
             }            
            
            ?> </p>
   

<?php
        }
        
        ?>
         <span class="responseshow">  </span>
      </div>
   
<?php
   $counter ++ ;  
}

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
     

</style>
<body>
<script src="finalpassword.js"></script>
<script src="detectTabnew.js"></script>
<script src="timmernew.js"></script>
<script src="gobackwords.js"></script>
<script src="studentAnswerNew.js"></script>
<script src="vertical_question_form_replace.js"></script>
     
</body>
</html>
