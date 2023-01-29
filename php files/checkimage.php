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
$selectStudentSQLneww = "SELECT * FROM studentchat WHERE senderStudentid='{$studentid}' AND   reciverstudentid='{$reciverID}' OR senderStudentid='{$reciverID}' AND reciverstudentid='{$studentid}'";

$selectStudentSQL_runnewww = mysqli_query($conn, $selectStudentSQLneww);
 

if(mysqli_num_rows($selectStudentSQL_runnewww)==0)
{
    ?>

<center>
    <h4 style="margin-top: 10px; opacity: 0.8;">Start chatting</h4>
    <img src="../images/chat_gqhlrp70xyr3.svg" alt="" class="img-thumbnail" style="width: 250px; height: 250px; margin-top: 120px; ">
   </center>
<?php
}





?>