<?php 


include("databaseconn.php");
session_start();
require("lectetrSESSION.php");
 

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
  $lecID = $_SESSION['lectureID'];
  $batchID = $_SESSION['batchID_new'];
  $subjectID = $_SESSION['subjectID_new'];

}


$examPaperID = $_GET['examPaperID'];
$paperName = $_GET['paperName'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrap.php"); ?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">

<style>

.thetitle{
  font-size: 20px;
  margin-left: 25px;
  margin-top: 25px;
}
  </style>
    <title>Current Exam Info</title>
</head>
<body>
<?php include("innerpreloader.php");?>
<?php include("lecturer_header.php")  ?>
<input type="hidden"  id="currentexamid"  value="<?php echo $examPaperID; ?>" />
<?php include("my_students_nav.php")  ?>

<div class="container">
   
<h6 class="thetitle"><?php echo $paperName?></h6>

  <div id="showtheresult">
     </div>

</div>

<script src="getcurrentexam.js"></script>  
 
</body>
</html>