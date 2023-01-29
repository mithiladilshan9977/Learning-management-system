<?php

include("databaseconn.php");
session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
 header("location:../index.php");
}
else{
    $studentid = $_SESSION['studentID'];
}


$reciverid =  mysqli_real_escape_string($conn ,$_POST['reciverID'] )  ;
$messgetext =  mysqli_real_escape_string($conn , $_POST['commentText']) ;

if(empty($messgetext))
{
    echo "<script>alert('No value')</script>";
}else{
    $inertQuery = "INSERT INTO studentchat(senderStudentid,reciverstudentid,message) VALUES('{$studentid}','{$reciverid}','{$messgetext}')";
    $inertQuery_run = mysqli_query($conn, $inertQuery);
}




?>