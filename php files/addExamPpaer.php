<?php 

include("databaseconn.php");
session_start();
error_reporting(0);
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




$selectpaper = "SELECT * FROM examinformation WHERE batchID='{$batchID}' AND lecturID='{$lecID}' and subjectID='{$subjectID}' ORDER BY examPaperID DESC";
$selectpaper_run = mysqli_query($conn, $selectpaper);
$getdata = mysqli_fetch_assoc($selectpaper_run);



$selectpapernewww = "SELECT * FROM examinformation WHERE batchID='{$batchID}' AND lecturID='{$lecID}' and subjectID='{$subjectID}' ORDER BY examPaperID DESC";
$selectpaper_runnnnn = mysqli_query($conn, $selectpapernewww);
$getdataaaa = mysqli_fetch_assoc($selectpaper_runnnnn);


$selectExmas = "SELECT * FROM examinformation WHERE batchID='{$batchID}' AND lecturID='{$lecID}' and subjectID='{$subjectID}'";
$selectExmas_run = mysqli_query($conn, $selectExmas);
 
 



$sqlone = "SELECT  * FROM question  WHERE question.examPaperID='$examID'";
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
    <title>Make Exams</title>
    <?php include("boostrap.php")?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.all.min.js">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
</head>
<style>
    .dropdownmenu{
        position: absolute;
        width: 500px;
        height: 600px;
        right: 10px;
        top: 110px;
        border-radius: 10px;
        box-shadow: 1px 1px 10px 1px rgba(0, 0, 0, 0.175);
        background-color: white;
    }
    .dropdownmenu{
        display: none;
    }
    #dropdownimage{
            opacity: 0.4;
            width: 100%;
            height: 100%;
position: absolute;
            text-align: center;
            margin: 0px auto;
        }
        .refreshwaring{
          font-size: 15px;
          margin-left: 10px;
          opacity: 0.7;
          color: red;
        }
</style>
<body>
<?php include("innerpreloader.php");?>
<?php include("lecturer_header.php")  ?>

<?php include("my_students_nav.php")  ?>

 <!-- Button trigger modal -->
   <div class="showthemessage"></div>

 <div class="containerrrrr" style="float: right; right: 10px; position: absolute; top:70px">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Add New Paper
</button>
</div>

<div class="containerrrrr" style="float: right; right: 150px; position: absolute; top:70px">
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalprint">
Print
</button>
</div>

<div class="containerrrrr" style="float: right; right: 214px; position: absolute; top:70px" >
<button type="button" class="btn btn-info" id="chekbowdropdown" >
Exams
</button>
</div>

<?php 
if($getdataaaa["status"] == 1)
{
  ?>

<div class="containerrrrr" style="float: right; right: 293px; position: absolute; top:70px" >
<a href="checkCurrentExam.php?examPaperID=<?php echo $getdataaaa['examPaperID'];?> & paperName=<?php echo $getdataaaa['paperName'];?>" class="btn btn-danger">Watch</a>
 
</div>
<?php
}
?>






 
<div class="dropdownmenu">
 

  <table class="table table-striped  ">
  

    <tbody>
        
    <?php if(mysqli_num_rows($selectExmas_run) == 0 ){
                echo '<img src="../images/undraw_appreciation_re_n3c1.svg " id="dropdownimage">';
        echo '<br>';
        echo '<center><h1>No Records Yet !</h1></center>';
        echo '<br>';
        echo '<center><h6>They will appear here </h6></center>';
            } else
            
            {?>
<thead>
            <tr>
            <th scope="col">Paper Name</th>
            <th scope="col"></th>
            </tr>
    </thead>

 
               <?php while($rows = mysqli_fetch_assoc($selectExmas_run))
                
                {
                    ?>
                         <tr> 
                 
                       <td><?php echo strtoupper($rows['paperName'])   ; ?></td>
                    
                       <td> <button class="btn btn-danger removebtn" data-bs-toggle="modal" data-bs-target="#exampleModalnew" value="<?php echo $rows['examPaperID']?>"  >REMOVE</button> </td>
                      

                       <div class="modal fade" id="exampleModalnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="showtherrror"></div>
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Paper</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Do you want to remove the exam paper ? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger removepaper"  >Remove</button>
      </div>
    </div>
  </div>
</div>


                </tr>



<?php

                }
            }
            
            ?>
    </tbody>
    </table>

</div>




 


<div class="container" style="margin-top: 50px; width: 100%;">

   <h4 class="nameofthePaper"><?php
   if(mysqli_num_rows($selectpaper_run)==0)
   {
    ?>  
    <center>
      <h4 class="my-2">Make New Exam Paper !</h4>
      <img src="../images/undraw_detailed_examination_re_ieui.svg" alt="" srcset="" style="width: 450px; height: 450px; margin-top: 80px;">
    </center>
    <?php
   }else{
   
    echo   strtoupper($examName = $getdata['paperName']) . "<small class='refreshwaring'>If the created paper is not visible, please refresh</small>" ;
      $_SESSION['EXAM_PAPER_ID'] = $getdata['examPaperID'];
   }
   
   
   ?></h4>

</div>

<div class="questionTemplteLoad"></div>


 
<?php 
if(mysqli_num_rows($sql_run) !== 0) {
 
 ?>
<div class="container" style="width: 800px; margin-top: 70px;  border: 1px solid black;  padding: 15px;">
<div class="header"  style="background-color: rgba(168, 168, 168, 0.325); padding: 10px; margin-bottom: 10px;">
<center>
  <img src="../images/camp.png" alt="" srcset="" class="thumbnail-img my-1" style="width: 150px; height: 150px;">
   <h2>Lecturer : <?php echo $LectFName .' ' .$LectFLName ?></h2>
   <h2>Saegis Campus</h2>
  

</center>
<p>Date : <?php echo  date("Y-m-d") ?> (<?php echo date("Y-M-D")?>)</p>
</div>
 <?php

}
?>

<?php while($hetquestion = mysqli_fetch_assoc($sql_run))
{
 ?>
<h6><?php echo $hetquestion['questionNumber'];?> ) <?php echo decryptthis($hetquestion['questionText'],$key);?></h6>
  <?php 
  $question = $hetquestion['questionNumber'];
  $selectoprion = "SELECT * FROM questionoptions WHERE questionNumber='$question' AND examPaperID='{$examID}'";
  $selectoprion_run = mysqli_query($conn, $selectoprion);
  
  for($s = 1 ; $s<=5 ;$s++)
  {
   ?>
 <p style="margin-left: 20px;"><?php $newtdaa = mysqli_fetch_assoc($selectoprion_run);
       echo $s . '. ' . decryptthis($newtdaa['options'],$key); ?> <?php if ($newtdaa['is_correct'] == '1') { ?> 
       <img src="../images/correct_bb6njyhdw0rf.svg" alt="" srcset="" style="width: 20px; height: 20px;">
       
       <?php }   ?>   </p>
   <?php
  }
  ?>


<?php
 
}

?>


<div class="modal fade" id="exampleModalprint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 

      <div class="modal-header">
        
        <h1 class="modal-title fs-5" id="exampleModalLabel">Take Print Exam Paper</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <?php   if (mysqli_num_rows($selectpaper_runnnnn) ==0)
      {
        ?>
            <center><p>No Papers To Print.</p></center>
        <?php
      }
      ?>
<a href="printPage.php?examPaperID=<?php echo $getdataaaa['examPaperID'];?> & paperName=<?php echo $getdataaaa['paperName'];?>" style="text-decoration: none;"><?php echo $getdataaaa['paperName'];?></a>

      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


 
 
 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="showthemesssgae"></div>

      <div class="modal-header">
        
        <h1 class="modal-title fs-5" id="exampleModalLabel">Exam Paper Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <label for="">Name of Exam Paper</label>
       <input type="text" class="form-control my-2" placeholder="Name of Exam" id="nameofpaper" required >

       <label for="">Time Period (Hours)  </label>
       <input type="text" class="form-control my-2" placeholder="Time In Hours" style="width: 58%; display: inline-flex; margin-left: 16px;" id="timeInHours" required>

       <label for="">Time Period (Minutes)</label>
       <input type="text" class="form-control my-2" placeholder="Time In Minutes" style="width: 58%; display: inline-flex;" id="timeInMinutes" required>


       <label for="">Password</label>
       <input type="text" class="form-control my-2" placeholder="This is used for end the exam" id="closesPassword" required>


       <label for="">Password (Repeat)</label>
       <input type="text" class="form-control my-2" placeholder="Repeat Password" id="repeatPassword" required>


       <label for="">Number Of Questions</label>
       <input type="number" name="" id="numberofuqestion" class="form-control my-2" min="1" max="50" placeholder="Number of Questions">
       <img src="../images/plus_7uy2lzykpxf9.svg" alt="" srcset="" style="width: 35px; height: 35px; cursor: pointer;" id="getNumnerOFforms">

   <b>   <span style="color: red;">(Add this after creating the paper)</span> </b>

      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-info" data-bs-dismiss="modal" id="startExamBTtn">Push</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="savebtn">Create Paper</button>
      </div>
    </div>
  </div>
</div>

  

</div>



 <script>
 $(document).ready(function () {
 
  var hours = 0;
  var addonehours = hours + 1;
  var munites = 0.1;
  var seconds = addonehours * munites * 60;
 
//  const startingNinutes = 10;
//  let time = startingNinutes * 60;

 var obj = setInterval(setUp , 1000);


  function setUp(){

    if(seconds ==0){
      clearInterval(obj);
      
    }
   
    let realhour = Math.floor(seconds/ (munites * 60) );
  
    let secondsreal = seconds % 60;
    const minuetseee = Math.floor(seconds/(60*addonehours));

    var timmer = $(".timmer");
 timmer.html(realhour +  ':' +  minuetseee + ':' +secondsreal );
 seconds--;
    
  }
  });
 </script>

<script type="text/javascript"  >
    $(document).ready(function () {
        $("#chekbowdropdown").on('click', function(){
    $(".dropdownmenu").slideToggle(500);
        });
    });
  </script>

   <script src="loadNumberOfQuestionsnew.js"></script>  
   <script src="examPaperInfromationnew.js"></script> 
   <script src="startExam.js"></script> 
<script src="removepaper.js"></script>
</body>
</html>
