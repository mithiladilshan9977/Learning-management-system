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

$examPaperID = $_GET['ExamPaperID'];

$_SESSION['EXAM_PAPER_ID'] = $examPaperID;

$examPaperName = $_GET['ExamPaperName'];


//get Total question
$selectQuestionnew = "SELECT * FROM question WHERE examPaperID='$examPaperID' AND studentID='$studentID' ORDER BY questionNumber  ASC";
$selectQuestion_runnew = mysqli_query($conn, $selectQuestionnew);

 $allQUestions =mysqli_num_rows($selectQuestion_runnew);


 $selectimenew = "SELECT * FROM examinformation WHERE batchID='{$studentbatch}' AND subjectID='{$studentid}'";
 $selectime_runnew = mysqli_query($conn, $selectimenew);
 $gettinewdatanew = mysqli_fetch_assoc($selectime_runnew);
 $examHours = $gettinewdatanew['hoursnew'];
 $examMunites = $gettinewdatanew['minutesnew'];

 
 $selectQuestionnew_second = "SELECT * FROM question WHERE examPaperID='$examPaperID' AND studentID='$studentID'";
$selectQuestion_runnew_second = mysqli_query($conn, $selectQuestionnew_second);

 $allQUestions_new =mysqli_num_rows($selectQuestion_runnew_second);


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
 

     

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams   </title>
    <link rel="shortcut icon" href="../images/file-location-dot-red-svg-wikipedia-0.png" type="x-icon">

    <?php include("boostrap.php")?>
</head>
<style>
     *,*::after , *::before{
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
     }
     .questiontitile{
        font-size: 30px;
     }
     .whatisquestion{
        font-size: 25px;
     }
     .questionHolder{
    
        padding: 10px;
     }
     .optionText{
        display: inline;
        font-size: 20px;
        margin-left: 5px;
     }
     .forwclass{
        width: 50px; height: 50px; padding: 80px; background-color:  rgba(41, 205, 0, 0.234); padding: 15px; transform: rotate(180deg); border: 1px solid rgba(0, 0, 0, 0.968); border-radius: 50%;
        transition:  all 0.2s ease-in-out;
     }
     .forwclass:hover{
        background-color:  rgba(41, 205, 0, 0.434);
        transition:  all 0.2s ease-in-out;
     }
     .backwordarrow{
        width: 50px; height: 50px; padding: 80px; background-color:  rgba(41, 205, 0, 0.234); padding: 15px;  border: 1px solid rgba(0, 0, 0, 0.968); border-radius: 50%;
        transition:  all 0.2s ease-in-out; 
     }
     .backwordarrow:hover{
        background-color:  rgba(41, 205, 0, 0.434);
        transition:  all 0.2s ease-in-out;
     }
     .moveingbtns{
        top:45px;
        position: relative;
   
        padding: 15px;
     }
     .good{

      color: rgb(32, 161, 0);
     }
     .bad{
      color: red;
     }
     .timmer{
      position: absolute;
      float: left;
      top: 10px;
   padding: 10px 19px;

      right: 10px;
      background-color:rgba(192, 192, 192, 0.156);
      border: 1px solid rgba(0, 0, 0, 0.956);
     }
     .hswotheerror{
      color: red;
     }
     .numberboxsx{
      width: 50px; height: 50px;   border: 1px solid blue; border-radius: 10px; padding: 10px; display: inline-block; position: relative; margin: 1px;
      transition: 0.2s all ease-in-out;

     }
     .numberboxsx:hover{
      background-color: rgba(34, 0, 255, 0.193);
      transition: 0.2s all ease-in-out;
      box-shadow: 1px 1px 5px 1px rgba(34, 0, 255, 0.393);
     }
</style> 
<body>
<?php include("innerpreloader.php");?>

<div id="response"> </div>
            <input type="hidden" value="<?php echo $examHours + 1?>" id="setHours">
               <input type="hidden" value="<?php echo $examMunites?>" id="setMunites">
 
                  <span class="showtime"> </span>

                 

<div class=" " style="border-bottom: 1px solid black; width: 100%; padding: 10px;">
    <h3 class="my-2" style="margin-left: 10px; margin-top: 10px;  display: inline-block;"><?php echo $examPaperName; ?> Online Paper</h3>  <h6 class="hswotheerror" style="display: inline-block; margin-left: 30px;  "></h6>
    <div class="timmer">
    

   
    </div>
   
</div>

<?php 
 if(isset($_GET['questionNumber']))
 {

 
     $questonnumberid = $_GET['questionNumber'];
   $jump_nav_next_question = $questonnumberid + 1;
   $nump_go_back_question = $questonnumberid - 1;
 $selectQuestionjumping = "SELECT * FROM question WHERE questionNumber='$questonnumberid' AND examPaperID='$examPaperID' AND studentID='$studentID' ORDER BY RAND() ";
 $selectQuestion_runjumping = mysqli_query($conn, $selectQuestionjumping);
 
 
 $getquestionjumping = mysqli_fetch_assoc($selectQuestion_runjumping);

   $namejumping = $getquestionjumping['questionText'];
   $questioNumberjumping = $getquestionjumping['questionNumber'];

   $selectoptions_jump = "SELECT * FROM questionoptions WHERE questionNumber='$questioNumberjumping' AND  examPaperID='$examPaperID' AND studentID='$studentID' ORDER BY RAND() ";
$selectoptions_run_jump = mysqli_query($conn, $selectoptions_jump);

 
 ?>
<div class="container" style="margin-top: 20px; width: 700px; padding: 20px; background-color: transparent; border: 2px dotted black; border-radius: 10px;">

<p class="my-2 questiontitile"  > <img src="../images/question_3ib9br6sq5ku.svg" alt="" srcset="" style="width: 38px; height: 38px; margin-right: 15px;"> Questions <?php echo $questioNumberjumping;?> of <?php echo  $allQUestions?></p>
</div>







<!-- jumping option question -->
<div class="container outerdiv" style="width: 650px; margin-top: 15px; position: relative;">
<b><p class="whatisquestion" style="margin: 10px;"><?php echo $questioNumberjumping.') ' . decryptthis($namejumping,$key) ;
?></p></b>
<?php 
while($datanewneww = mysqli_fetch_assoc($selectoptions_run_jump))
{
    ?>
    <div class="questionHolder">
        
<input type="radio" name="question"  <?php if ($datanewneww['studentGivenAn'] == 1) {
            echo 'checked'; }?> class="my-1 studentAnswer" value="<?php echo $datanewneww['optionID'];?>"  style="cursor: pointer;"> <p class="optionText"> <?php echo decryptthis($datanewneww['options'],$key); ?></p>  
</div>
    <?php
}

?>


<?php 

if($questioNumberjumping >=2)
{
    ?>
    <a href="questions.php?questionNumber=<?php echo $nump_go_back_question;?> & ExamPaperID=<?php echo $examPaperID?> & ExamPaperName=<?php echo $examPaperName?>"  class="moveingbtns"><img src="../images/backward_arrow_t9553ymrahtf.svg"   alt="" srcset="" class="backwordarrow"></a>
    
    <?php
}
 
if($questioNumberjumping < $allQUestions_new)

{
    ?>
<a href="questions.php?questionNumber=<?php echo $jump_nav_next_question;?> & ExamPaperID=<?php echo $examPaperID?> & ExamPaperName=<?php echo $examPaperName?>"  class="moveingbtns"><img src="../images/backward_arrow_t9553ymrahtf.svg"   alt="" srcset="" class="forwclass"> </a>
    <?php
}
?>
<div class="btnholder" style="  position: absolute; right: 10px;">
         <small class="showeeeror" style="position: absolute; right: 10px; bottom: 40px;"></small>
 <button class="btn btn-outline-success submitStudentAnser" style=" position: relative; right: 10px; " id="">Submit Answer</button>
<?php 
if($questioNumberjumping == $allQUestions_new)
{
   ?>
<a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">End Paper</a>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="showmessage"></div>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Password is needed</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <input type="text" class="form-control" placeholder="Enter Exam Password" id="passwordinput"> 
      </div>
      <p class="mt-1" style="margin-left: 18px;">This should be done. Otherwise marks will not be added !</p>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="okbtn">Ok</button>
      </div>
    </div>
  </div>
</div>
 
 
 
   <?php
}

?>

</div>
</div>  
 

 <?php
  }




?>
<!-- //////////////// for singel navigation -->

<?php 
if(isset($_GET['number']))
{$statringNumber =  $_GET['number'];
   $nextNumber = $statringNumber + 1;
   $previoueNumber = $statringNumber - 1;
   
   $selectQuestion = "SELECT * FROM question WHERE questionNumber='$statringNumber' AND examPaperID='$examPaperID' AND studentID='$studentID' ORDER BY RAND()";
   $selectQuestion_run = mysqli_query($conn, $selectQuestion);
   
   $getquestion = mysqli_fetch_assoc($selectQuestion_run);
   $name = $getquestion['questionText'];
   $questioNumber = $getquestion['questionNumber'];
   $_SESSION['QESTIONNUMBER'] = $questioNumber;
   
   
   //options
   
   $selectoptions = "SELECT * FROM questionoptions WHERE questionNumber='$statringNumber' AND  examPaperID='$examPaperID' AND studentID='$studentID' ORDER BY RAND()";
   $selectoptions_run = mysqli_query($conn, $selectoptions);
   ?>

<div class="container" style="margin-top: 20px; width: 700px; padding: 20px; background-color: transparent; border: 2px dotted black; border-radius: 10px;">

<p class="my-2 questiontitile"  > <img src="../images/question_3ib9br6sq5ku.svg" alt="" srcset="" style="width: 38px; height: 38px; margin-right: 15px;"> Questions <?php echo $questioNumber;?> of <?php echo  $allQUestions?></p>
</div>


<!-- //////////////////////////////////////////////////////////////// -->
<div class="container outerdiv" style="width: 650px; margin-top: 15px; position: relative;">
<b><p class="whatisquestion" style="margin: 10px;"><?php echo $questioNumber.') ' . decryptthis($name,$key) ;
?></p></b>
<?php 
while($datanew = mysqli_fetch_assoc($selectoptions_run))
{
    ?>
    <div class="questionHolder">
        
<input type="radio" name="question" required  <?php if ($datanew['studentGivenAn'] == 1) {
            echo 'checked'; }?> class="my-1 studentAnswer" value="<?php echo $datanew['optionID'];?>"  style="cursor: pointer;"> <p class="optionText"> <?php echo decryptthis($datanew['options'],$key); ?></p>  
</div>
    <?php
}

?>


<?php 

if($nextNumber > 2)
{
    ?>
    <a href="questions.php?number=<?php echo $previoueNumber?> & ExamPaperID=<?php echo $examPaperID?> & ExamPaperName=<?php echo $examPaperName?>"  class="moveingbtns"><img src="../images/backward_arrow_t9553ymrahtf.svg"   alt="" srcset="" class="backwordarrow"></a>
    
    <?php
}
 
if($nextNumber !==($allQUestions + 1))
{
    ?>
<a href="questions.php?number=<?php echo $nextNumber?> & ExamPaperID=<?php echo $examPaperID?> & ExamPaperName=<?php echo $examPaperName?>"  class="moveingbtns"><img src="../images/backward_arrow_t9553ymrahtf.svg"   alt="" srcset="" class="forwclass"> </a>
    <?php
}
?>
<div class="btnholder" style="  position: absolute; right: 10px;">
         <small class="showeeeror" style="position: absolute; right: 10px; bottom: 40px;"></small>
 <button class="btn btn-outline-success submitStudentAnser" style=" position: relative; right: 10px; " id="">Submit Answer</button>
<?php 
if($nextNumber > $allQUestions)
{
   ?>
<a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">End Paper</a>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="showmessage"></div>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Password is needed</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <input type="text" class="form-control" placeholder="Enter Exam Password" id="passwordinput"> 
      </div>
      <p class="mt-1" style="margin-left: 18px;">This should be done. Otherwise marks will not be added !</p>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="okbtn">Ok</button>
      </div>
    </div>
  </div>
</div>
 
 
 
   <?php
}

?>

</div>
</div>  



<?php
}

?>
<!-- //////////////////////////////////////////////////////////// -->
<!-- number navigation -->
<div class="container" style=" position: fixed;bottom:240px; right: 10px; width: 400px; height: 395px;  padding: 5px;"> 
 <?php 
 while($newdataanew = mysqli_fetch_assoc($selectQuestion_runnew)) {
    $questionNumber = $newdataanew['questionNumber'];
    $selectcount = "SELECT MAX(studentGivenAn) as studentGivenAn,questionNumber FROM questionoptions WHERE questionNumber='{$questionNumber}' AND examPaperID='{$examPaperID}' AND studentID='$studentID' ";
    $selectcount_run = mysqli_query($conn, $selectcount);
    $resultnew = mysqli_fetch_assoc($selectcount_run);
   
   ?>
 <span class="numberboxsx"  >

<?php 
if($resultnew['studentGivenAn'] == 1)
{
   ?>
   <img src="../images/hd-green-dot-circle-icon-11642066802ysgbn4cpvp.png" style="width: 12px; height: 12px; position: absolute;  top: -5px;  margin-left: 9px;" alt="" srcset="">
   <?php
}
?>
 
 
 
<a href="questions.php?questionNumber=<?php echo $newdataanew['questionNumber'];?> & ExamPaperID=<?php echo $examPaperID?> & ExamPaperName=<?php echo $examPaperName?>" style="align-items: center; position: relative; bottom: 7px; text-decoration: none; padding: 10px; width: 100%; height: 100%; display: block; margin: 0px auto;"><?php echo $newdataanew['questionNumber'];?></a>
 </span>

<?php
 }
 
 ?>


 
 
 
 
 
</div>







</body>
 <script>
setInterval(function (){
   var thewindoWidth = window.innerWidth;
   if(thewindoWidth < 1200){
      alert("You are detected !.Don't try to minimize the tab");

var data  = "thewidownWidth="  + window.innerWidth;

$.ajax({
            type: "POST",  //默认get
            url: "exam_mistakes_minimise.php",  //默认当前页
            data: data,  //格式{key:value}
          
            
            success: function (response) {  //请求成功回调
                $(".hswotheerror").html(response);
            },
             
        })




   }
   
} , 1000);

   
 </script>
<script type="text/javascript">
  var obj =   setInterval(function(){
 
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET" , "responsenew.php" , false);
   xmlhttp.send(null);
   document.getElementById("response").innerHTML =xmlhttp.responseText; 


    },1000);
 </script>
 
 <script src="finalpassword.js"></script>
<script src="detectTabnew.js"></script>
<script src="timmernew.js"></script>
<script src="gobackwords.js"></script>
<script src="studentAnswer.js"></script>
 
</html>