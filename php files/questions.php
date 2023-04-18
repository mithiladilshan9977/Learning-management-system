<?php 

include("databaseconn.php");
session_start();
//  error_reporting(0) ;
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
  

   //get encrypt and decript data

   

$selectquesry = "SELECT * FROM question where studentID='{$studentID}' AND examPaperID='$examPaperID' ";
$selectquesry_run = mysqli_query($conn ,$selectquesry);
$getSelectdata = mysqli_fetch_assoc($selectquesry_run);
 


//get Total question
$selectQuestionnew = "SELECT * FROM question WHERE examPaperID='$examPaperID' AND studentID='$studentID' ORDER BY questionNumber  ASC";
$selectQuestion_runnew = mysqli_query($conn, $selectQuestionnew);

 $allQUestions =mysqli_num_rows($selectQuestion_runnew);


 $selectimenew = "SELECT * FROM examinformation WHERE batchID='{$studentbatch}' AND subjectID='{$studentid}'";
 $selectime_runnew = mysqli_query($conn, $selectimenew);
 $gettinewdatanew = mysqli_fetch_assoc($selectime_runnew);
 $examHours = $gettinewdatanew['hoursnew'];
 $examMunites = $gettinewdatanew['minutesnew'];
 $limiteTo = $gettinewdatanew['limitTo'];
 $exampaperName =  $gettinewdatanew['paperName'];
 $lecID =  $gettinewdatanew['lecturID'];
 $limiteNumber =  $gettinewdatanew['limitTo'];
 $_SESSION['NUMBER_OF_QUESTIONS'] =  $limiteNumber;

 $selectlectur = "SELECT * FROM lecture WHERE lectureID='{$lecID}'";
 $selectlectur_run = mysqli_query($conn , $selectlectur);
 $getlecdata = mysqli_fetch_assoc($selectlectur_run);
 $Fnamelec =  $getlecdata['firstname'];
 $Lnamelec =  $getlecdata['lastname'];



 
 $selectQuestionnew_second = "SELECT * FROM question WHERE examPaperID='$examPaperID' AND studentID='$studentID'  ";
$selectQuestion_runnew_second = mysqli_query($conn, $selectQuestionnew_second);


 $allQUestions_new =mysqli_num_rows($selectQuestion_runnew_second);
 
 

 $reandomSQL = "SELECT * FROM question WHERE examPaperID='$examPaperID' AND studentID='$studentID' AND deleteornot='0' ORDER BY RAND()   LIMIT  $limiteTo";
 $reandomSQL_run = mysqli_query($conn, $reandomSQL);
 $endNumber = mysqli_num_rows($reandomSQL_run);

//checking is it alredy inserted // remove refresh
$refrechSelect = "SELECT * FROM questionselected WHERE examPaperID='$examPaperID' AND studentID='$studentID'";
$refrechSelect_run = mysqli_query($conn , $refrechSelect);
$numberforows = mysqli_num_rows($refrechSelect_run);
 

 if($reandomSQL_run){
 
   if($numberforows == $limiteTo){
 
   }else{
      for($s = 1 ; $s <=$endNumber ; $s++){
         $questionData = mysqli_fetch_assoc($reandomSQL_run) ;
           $questionNumber = $questionData['questionNumber'];
           $theQuestionText = $questionData['questionText'];
           $questionType = $questionData['questionType'];

   
         $InsertSelectedQuestions = "INSERT INTO questionselected (examPaperID,questionType,questionNumber,LecID,studentID,questionText) VALUES('$examPaperID' ,'$questionType', '$questionNumber','$lecID','$studentID', '$theQuestionText')";
         $InsertSelectedQuestions_run = mysqli_query($conn , $InsertSelectedQuestions);
         if( $InsertSelectedQuestions_run){
           
            continue;
         }else{
            echo "Somthing went wrong";
         }
      }
   }

  

 }
 $selectNotChangeQuestion = "SELECT * FROM questionselected WHERE examPaperID='$examPaperID' AND studentID='$studentID'";
 $selectNotChangeQuestion_run = mysqli_query($conn , $selectNotChangeQuestion);

 //creating button to navigate
 $buttonToNavigate = "SELECT * FROM questionselected WHERE examPaperID='$examPaperID' AND studentID='$studentID'  ";
 $buttonToNavigate_run = mysqli_query($conn , $buttonToNavigate);
 
 ?>
<div class="container ouertButtonHolder">
 <?php
 $counternew = 1;
 while( $getButtonData = mysqli_fetch_assoc($buttonToNavigate_run))
 {
   ?>
   
   <div class="container buttonHolder">
   <input type="hidden"   class="inputNumberField" value="<?php echo $getButtonData['questionNumber'] ; ?>">
   <input type="hidden"   class="inputFieldCounter" value="<?php echo $counternew  ; ?>">

   <span class="container buttoonOuterHolder">
                       
               <button class="navigateButton"><?php echo $counternew; ?>
               <span class="greenisonholder"></span>  
            
</button>

               </span>
 </div>

   <?php
   $counternew ++ ;  
 }
 ?>
 </div>
 <?php
  

 
 
//upload by excel or not
$updalodbyornotSQL = "SELECT * FROM question where lectureID='{$lecID}' AND examPaperID='$examPaperID' AND deleteornot='0'";
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
     
    
     .ouertButtonHolder{
      position: relative ;
 
  width:27%;
  float:right;
  top:300px;
  margin-right: 1px;
  z-index: 100;
  flex-wrap: wrap;
 display: flex;
  
     }
     .navigateButton{
      display:inline-block;
      width:50px;
      height: 50px;
      margin:5px;
      border-radius:50%;
      background-color: blue;
      color:white;
      border:none;
     }
     .buttonHolder{
      display: inline-block;
      width:20%;
 
      float: left;
     }
    
     .inputNumberField{
      display: none;
      width: 1%;
      background-color: red;
      position: relative;
      margin-top: 250px;
      color:white;
      height:1%;
     }
     .inputFieldCounter{
        display: none;
        width: 1%;
        
      color:white;
      height:1%;
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
      position: fixed;
      float: left;
      top: 10px;
 

   padding: 10px 19px;
   border-radius: 15px;
      right: 10px;
      color: rgb(0, 27, 123);
      background-color: rgba(0, 213, 255, 0.395) ;
     }
     .hswotheerror{
 
    
      width:100%;
      height:120vh;
 
      top:5px;
 
 
   
     }
     .showtheErrorText{
      text-align: center;
  font-size: 25px;
  margin-top: 50px;
  position: absolute;
  color: rgb(184, 0, 0);
     }
     #mainouterErrorDiv{
      width:100%;

      background-color: rgba(255, 0, 0, 0.922);
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

     .quesnumberValue{
       display: none;
     }
     .maincontainerbox{
 
      border: 2px solid rgba(0, 0, 0, 0.822);
 
      height:700px;

 
      border-radius: 15px;
      padding: 15px;
      overflow: hidden;
    
     }
     .whatisquestionbox{
      background-color:rgba(0, 204, 255, 0.286);
      border-radius: 10px;
      padding: 10px;
     
      font-size: 23px;
      font-weight: bold;
      

     }
     .optionsBox{
      padding: 10px 0px 0px 20px;
      font-size: 18px;
      margin-bottom: 150px;

     }
     body{
      touch-action: none;
     }
     .whatisquestionCSS{
      color: rgba(10, 0, 100, 0.886);
      font-size: 18px;
     }
     .campImage{
      max-width: 150px;
      min-height: 150px;
      text-align:center;
      margin: 0px auto;
     }
     .mainheader{
      
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
     ::-webkit-scrollbar {
  width: 15px; /* width of the scrollbar */
  height: 5px; /* height of the scrollbar */
}

/* Define the style for the scrollbar track */
::-webkit-scrollbar-track {
  background: #f1f1f1; /* color of the scrollbar track */
}

/* Define the style for the scrollbar thumb */
::-webkit-scrollbar-thumb {
  background: linear-gradient(rgba(0, 213, 255, 0),rgb(0, 171, 206)); /* color of the scrollbar thumb */
  border-radius: 5px; /* rounded corners */
}
::-webkit-scrollbar-thumb :hover{
   cursor: pointer;
   
}
.endpaperBUtton{
   position: fixed;
   bottom: 10px;
   right:10px;
}
.name{
   background-color: rgba(255, 0, 0, 0.122);
}
</style> 
<body class="body">
<?php include("innerpreloader.php");?>

<div id="response"> </div>
 



 

<!-- //////////////////////////////////////////////////////////////////////////////// -->
<div class="container maincontainerbox" style="width:70% ;   float: left; margin-left: 55px; top:-90px;position: relative;">
<div class="modal-header mainheader">

         <img src="../images/camp.png" class="rounded float-start campImage"/>  
<p class="showtheErrorText"></p>
         
  </div>
 
  <div class="modal-header  inforBox">
 <p><b>Conducted By </b>: <?php echo  $Fnamelec .' '.  $Lnamelec?></p>
 <p><b>Subject </b>:  <?php echo  $exampaperName ;?> MCQ paper</p>  
 <p><b>Time </b>: <?php echo  $examHours .'.'. $examMunites  ?> Hours</p> 
 <p>Answer all <?php echo   $limiteNumber ?> questions</p> 



   </div>

   <span class="addquestion"> </span>  
<?php 
 
 

$counter = 1;
while($rows = mysqli_fetch_assoc($selectNotChangeQuestion_run))
{  
     
    

     ?>
       <div class="container whatisquestionbox">
        
          
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
   $counter ++ ;  
}

?>

</div>

<a href="" class="btn btn-outline-danger endpaperBUtton" data-bs-toggle="modal" data-bs-target="#exampleModal">End Paper</a>


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



 


            <input type="hidden" value="<?php echo $examHours + 1?>" id="setHours">
               <input type="hidden" value="<?php echo $examMunites?>" id="setMunites">
 
                  <span class="showtime"> </span>

                 

<div class=""  id=" ">

      <h6 class="hswotheerror">

       
      </h6>
    <div class="timmer"> </div>
   
</div>
 

 

</body>
 <!-- <script>
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
                $(".showtheErrorText").html(response);
                $(".hswotheerror").addClass("name");
                setTimeout(() => {
                  $(".showtheErrorText").html(" ");
                  $(".hswotheerror").removeClass("name")
                }, 5000);
            },
             
        })




   }
   
} , 1000);

   
 </script> -->
<script type="text/javascript">
  var obj =   setInterval(function(){
 
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET" , "responsenew.php" , false);
   xmlhttp.send(null);
   document.getElementById("response").innerHTML =xmlhttp.responseText; 


    },1000);
 </script>


 

  <script src="vertical_question_form_replace.js"></script>
  <script src="getSingelQuestionSecond_replace.js"></script>
 <script src="finalpassword.js"></script>
<script src="detectTabNew.js"></script>
<script src="timmernew.js"></script>
<script src="gobackwords.js"></script>
<script src="studentAnswerNew.js"></script>

<script src="checkAnderCountoously.js"></script>

 


 
</html>