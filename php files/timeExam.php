 

<?php

include("databaseconn.php");
 
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
  header("location:../index.php");
}else{
    $studentbatch = $_SESSION['STUDENTBATCH'];
    $studentid = $_SESSION['subjectID'];
}
 

$selectimenew = "SELECT * FROM examinformation WHERE batchID='{$studentbatch}' AND subjectID='{$studentid}'";
$selectime_runnew = mysqli_query($conn, $selectimenew);
$gettinewdatanew = mysqli_fetch_assoc($selectime_runnew);
$examHours = $gettinewdatanew['hoursnew'];
$examMunites = $gettinewdatanew['minutesnew'];




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
     <input type="hidden" value="<?php echo $examHours + 1?>" id="setHours">
     <input type="hidden" value="<?php echo $examMunites?>" id="setMunites">
       <span class="showtime"></span>
 
 
</body>
</html>
