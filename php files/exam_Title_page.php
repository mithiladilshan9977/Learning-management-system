<?php 

include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}

$ExamPaperID = $_GET['ExamPaperID'];
$ExamPaperName = $_GET['ExamPaperName'];

$selectquetionsSQL = "SELECT * FROM question WHERE examPaperID='{$ExamPaperID}'";
$selectquetionsSQL_run = mysqli_query($conn, $selectquetionsSQL);

$selectime = "SELECT * FROM examinformation";
$selectime_run = mysqli_query($conn, $selectime);
$gettinewdata = mysqli_fetch_assoc($selectime_run);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Exam Notice</title>
    <?php include("boostrap.php")?>
</head>
<style>
     *,*::after , *::before{
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
     }
     .titleofexam{
   font-size: 40px;
 
  
     }
</style>
<body>
<?php include("innerpreloader.php");?>

 

<div class=" " style="border-bottom: 1px solid black; width: 100%; padding: 10px;">
    <h3 class="my-2" style="margin-left: 10px; margin-top: 10px; ">Go - Xm Exam Platform</h3>
    
</div>



<div class="container" style="margin-top: 20px; width: 700px; padding: 18px; ">
 
      <h3 class="my-2 titleofexam" ><?php echo $ExamPaperName; ?></h3>

      <h5 class="mb-3" style="color: red;">Notice</h5>
         <h6 style="color: red;" class="my-1"><img src="../images/alert_r40zlm4fyegc.svg" alt="" srcset="" style="width: 20px; height: 20px; position: relative; top: -3px; right: 10px;"> Do not try to open other tab.</h6>

         <h6 style="color: red;" class="my-1"><img src="../images/alert_r40zlm4fyegc.svg" alt="" srcset="" style="width: 20px; height: 20px; position: relative; top: -3px; right: 10px;"> Do not minisize the window.</h6>

         <h6 style="color: red;" class="my-1"><img src="../images/alert_r40zlm4fyegc.svg" alt="" srcset="" style="width: 20px; height: 20px; position: relative; top: -3px; right: 10px;"> Do not  try to close the window.</h6>

         <h6 style="color: red;" class="my-1"><img src="../images/alert_r40zlm4fyegc.svg" alt="" srcset="" style="width: 20px; height: 20px; position: relative; top: -3px; right: 10px;">All the tasks will be recored.</h6>

         <h6 style="color: red;" class="my-1"><img src="../images/alert_r40zlm4fyegc.svg" alt="" srcset="" style="width: 20px; height: 20px; position: relative; top: -3px; right: 10px;">Press 'Submit answer' button on each submition.</h6>

         <h6 style="color: red;" class="my-1"><img src="../images/alert_r40zlm4fyegc.svg" alt="" srcset="" style="width: 20px; height: 20px; position: relative; top: -3px; right: 10px;">Electronic devices are not allowed.</h6>

         <h6 style="color: red;" class="my-1"><img src="../images/alert_r40zlm4fyegc.svg" alt="" srcset="" style="width: 20px; height: 20px; position: relative; top: -3px; right: 10px;">If something wrong with paper, let lecturer knows.</h6>





      <p class="" style="margin: 10px;">This is a multiple choise quiz.</p>

      <p class="my-2"><strong>Number of Questions : </strong> <?php echo mysqli_num_rows($selectquetionsSQL_run)?> </p>
      <p class="my-2"><strong>Type : </strong>Multiple Choise</p>
      <p class="my-2"><strong>Estimated Time : </strong> <?php echo $gettinewdata['hoursnew'].' : ' . $gettinewdata['minutesnew']  ?> Hours</p>


      <a href="questions.php?number=1 & ExamPaperID=<?php echo $ExamPaperID;?> & ExamPaperName=<?php echo  $ExamPaperName; ?>" class="btn btn-success mt-2">Start Quize</a>

</div>
</body>
</html>