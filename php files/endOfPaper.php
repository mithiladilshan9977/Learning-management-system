<?php 

include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
} else{
  $studentid = $_SESSION['studentID'];
     $numberofCorrectAnswers =  $_SESSION['STUDENT_GIVEN_ANSWERS'];
}
 

$examPaperID = $_GET['examPaperID'];

$selectQuestionnew = "SELECT * FROM question WHERE examPaperID='$examPaperID'";
$selectQuestionnew_run = mysqli_query($conn, $selectQuestionnew);
  $allQuestions = mysqli_num_rows($selectQuestionnew_run);


$selectstudent = "SELECT * FROM student WHERE studentID='{$studentid}'";
$selectstudent_run = mysqli_query($conn, $selectstudent);
$getdata = mysqli_fetch_assoc($selectstudent_run);

$selectDetect = "SELECT * FROM detectexam WHERE studentID='{$studentid}' AND examid='{$examPaperID}'";
$selectDetect_RUN = mysqli_query($conn, $selectDetect);
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>End of paper</title>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <?php include("boostrap.php")?>
</head>
<style>
    *,*::after,*::before{
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
    }
    .infortitle{
      padding: 10px;
      background-color: rgba(165, 165, 165, 0.125);
    }
</style>
<body>
<?php include("innerpreloader.php");?>
<?php include("student_header.php")  ?>
<div class="containerrrrr" style="float: right; right: 14px; position: absolute; top:70px">
<button type="button" class="btn btn-warning"  onclick="window.print()">
 Print the results
</button>
</div>
<div class="container" style="max-width: 800px;   margin-top: 60px">
<div class="header" style="  width: 100%; min-height: 50px;  padding: 10px;">
<h3>You have successfully completed the Exam</h3>
</div>

<h4 class="my-2 infortitle">Information about the Student</h4>

 
   <label for="">Name of student : </label> <p class=" " style=" display: inline-block; margin-left: 10px;"><?php echo $getdata['firstname'] . ' ' . $getdata['lastname']?></p>
 <br>
   <label for="">Index Number    : </label> <p class=" " style=" display: inline-block; margin-left: 10px;"><?php echo $getdata['indexnumber']?></p>
<br>
   <label for="">Correct Answers   : </label> <p class=" " style=" display: inline-block; margin-left: 10px;"><?php echo $numberofCorrectAnswers;?></p>

 <hr>

<?php 

if(mysqli_num_rows($selectDetect_RUN) == 0)
{
  ?>
   <h3 class="my-1" style="color: rgba(0, 186, 28, 0.925);">   No suspicious attempts are reported .  </h3>
  <?php
}
else
{
  ?>
<h6 class="my-3" style="color:red ; position: relative;">Mistakes you have made</h6>

<h6 style="color: red;" class="my-1"><img src="../images/alert_r40zlm4fyegc.svg" alt="" srcset="" style="width: 20px; height: 20px; position: relative; top: -3px; right: 10px;"><?php echo mysqli_num_rows($selectDetect_RUN)?> suspicious attempts are detected.</h6>

  <?php

}

?>

 




<h6 class="mt-3"> <strong>Marks you scored : </strong>   </h6> 
<p style="font-size: 40px;"><?php echo $thFinelMarks = round(($numberofCorrectAnswers / $allQuestions) * 100);?> %</p>

</div>
<center> <p>Now you can log out from the system. <a href="student_logout.php">Log out</a></p>  </center>
  
</body>
</html>