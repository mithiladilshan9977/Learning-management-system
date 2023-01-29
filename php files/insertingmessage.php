<?php 

include("databaseconn.php");
 session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
  header("location:../index.php");
}
else{
    $senderid = $_SESSION['studentID'];
}


$reciverid = $_POST['theval'];
$messagecontect = $_POST['messagecontent'];


$insertdata = "INSERT INTO studentchat(senderStudentid,reciverstudentid,message) VALUES ('$senderid' ,'$reciverid' , '$messagecontect' )";
$insertdata_run = mysqli_query($conn, $insertdata);




?>