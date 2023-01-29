<?php 

include("databaseconn.php");
session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
 header("location:../index.php");
}
else{
 $studentid = $_SESSION['studentID'];
 $studeBatch =  $_SESSION['STUDENTBATCH'];
}
$reciverID = $_POST['reciverID'];
$selectStudentSQLnew = "SELECT * FROM student WHERE studentID ='{$reciverID}'";
$selectStudentSQL_runnew = mysqli_query($conn, $selectStudentSQLnew);
$getdata = mysqli_fetch_assoc($selectStudentSQL_runnew);
$status = $getdata['greenicon'];
if($status=='1')
{
    ?>
<img class="img-thumnail onlineicon"src="../images/pngfind.com-dot-icon-png-2698936.png" alt="" style="width: 15px; height: 15px;" >
    <?php
} 





?>