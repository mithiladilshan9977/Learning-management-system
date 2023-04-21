<?php 

include("databaseconn.php");
session_start();
error_reporting();

// require("lectetrSESSION.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}
 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams</title>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <?php include("boostrap.php")?>
</head>
<style>
     
</style>
<body>
<?php include("innerpreloader.php");?>

<?php include("student_header.php")  ?>

<?php include("student_naviga_bar.php")  ?>

 

<div class="addLink"></div>

<script src="getExamLink2.js"></script>
</body>
</html>