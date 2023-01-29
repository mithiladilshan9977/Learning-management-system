<?php 


include("databaseconn.php");
session_start();
  // require("lectetrSESSION.php");
 
if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
    $lecID = $_SESSION['lectureID'];
}


$imageid = $_POST['imageid'];
$thebatchid = $_POST['thebatchid'];

$updateimageSQL = " SELECT teacherclass.*,subject.*,batch.* , classimage.* FROM teacherclass LEFT JOIN subject ON teacherclass.subjectID = subject.subjectId LEFT JOIN batch ON teacherclass.batchID = batch.BatchID LEFT JOIN classimage ON teacherclass.thubnails=classimage.classimageid WHERE teacherID='$lecID' AND classstatus='0'";

$updateimageSQL_run = mysqli_query($conn, $updateimageSQL);
$getdatanew = mysqli_fetch_assoc($updateimageSQL_run);
  $BatchID = $getdatanew['BatchID'];
  $subjectID = $getdatanew['subjectID'];

$updateimage = "UPDATE teacherclass SET thubnails='$imageid' WHERE  teacherID='$lecID' AND batchID='{$thebatchid}'";
$updateimage_run = mysqli_query($conn, $updateimage);
if($updateimage_run){
    echo "<small class='good'>Done</small>";
}else{
    echo "error";
}



?>