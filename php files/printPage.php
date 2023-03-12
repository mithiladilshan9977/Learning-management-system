


<?php 


include("databaseconn.php");
session_start();
require("lectetrSESSION.php");
error_reporting(0);

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
  $lecID = $_SESSION['lectureID'];
  $batchID = $_SESSION['batchID_new'];
  $subjectID = $_SESSION['subjectID_new'];

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


  $examPaperID = $_GET['examPaperID'];
$paperName = $_GET['paperName'];

$selectquesry = "SELECT * FROM question where lectureID='{$lecID}' AND examPaperID='$paperName' ";
    $selectquesry_run = mysqli_query($conn ,$selectquesry);
    $getSelectdata = mysqli_fetch_assoc($selectquesry_run);

$sqlone = "SELECT  *,COUNT(*) FROM question  WHERE question.examPaperID='$examPaperID' GROUP BY questionText HAVING COUNT(*) >1 ORDER BY questionNumber ASC";
$sql_run = mysqli_query($conn, $sqlone);

$selectLecture = "SELECT lecture.* , deprtment.* FROM lecture LEFT JOIN deprtment ON lecture.departmentID = deprtment.depaermentID WHERE lecture.lectureID='{$lecID}'";
$selectLecture_run = mysqli_query($conn, $selectLecture);
$getLecData = mysqli_fetch_assoc($selectLecture_run);
$LectFName = $getLecData['firstname'];
$LectFLName = $getLecData['lastname'];
$DpaetmentName = $getLecData['departmentName'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Paper</title>
    <?php include("boostrap.php")?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
</head>
<style>
     
</style>
<body>
<?php include("innerpreloader.php");?>
 

<div class="containerrrrr" style="float: right; right: 14px; position: absolute; top:10px">
<a href="addExamPpaer.php" style="text-decoration: none; margin-right: 10px;"><img src="../images/back_jt1llsyhe2s4.svg" style="width: 20px; height: 20px;"></a>
<button type="button" class="btn btn-warning"  onclick="window.print()">
 Print
</button>
</div>


<div class="container" style="width: 800px; margin-top: 70px;  border: 1px solid black;  padding: 15px;">
<div class="header"  style="background-color: rgba(168, 168, 168, 0.325); padding: 10px; margin-bottom: 10px; border: 1px solid rgba(181, 181, 181, 0.316)">
 <center>
 <img src="../images/camp.png" alt="" srcset="" class="thumbnail-img my-1" style="width: 150px; height: 150px;">
    <h2>Lecturer : <?php echo $LectFName .' ' .$LectFLName ?></h2>
    <h2>Saegis Campus</h2>
  
 
 </center>
 <p>Subject - <?php echo $paperName?></p>
 <p style=" bottom: 10px; position: relative;"><?php echo date("Y-d-m") ?>(<?php echo date("Y-D-M")?>)</p>
</div>
<?php 
 
while($hetquestion = mysqli_fetch_assoc($sql_run))
{
  ?>
  
<h6><?php echo $hetquestion['questionNumber'];?> )

<?php echo $hetquestion['questionNumber'];?> ) <?php 
if($getSelectdata['uploadByExcelOrnot'] == 1){
echo decryptthis($hetquestion['questionText'],$key);  

}else{
  echo decryptthis($hetquestion['questionText'],$keyee);  

}

?>

</h6>
   <?php 
   $question = $hetquestion['questionNumber'];
   $selectoprion = "SELECT * FROM questionoptions WHERE questionNumber='$question' AND examPaperID='{$examPaperID}'";
   $selectoprion_run = mysqli_query($conn, $selectoprion);
   
   for($s = 1 ; $s<=5 ;$s++)
   {
    ?>

    <!-- ///////////////////////////////// -->
  <p style="margin-left: 20px;"><?php $newtdaa = mysqli_fetch_assoc($selectoprion_run);

if($getSelectdata['uploadByExcelOrnot'] == 1){
  echo $s . '. ' . decryptthis($newtdaa['options'],$key);     
}else{
  echo $s . '. ' . decryptthis($newtdaa['options'],$keyee);     

}?> 
                       
                       
                       <?php if ($newtdaa['is_correct'] == '1') { ?> 
                        <img src="../images/correct_bb6njyhdw0rf.svg" alt="" srcset="" style="width: 20px; height: 20px;">
                        
                        <?php }   ?></p>
    <?php
   }
   ?>
 

<?php
}

?>
</div>
    
</body>
</html>



