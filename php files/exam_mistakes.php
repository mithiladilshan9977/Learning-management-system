<?php 
include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}else{
    $studentid = $_SESSION['studentID'];
   $studentbatch = $_SESSION['STUDENTBATCH'];
   $subjectID = $_SESSION['subjectID'];
   $examID = $_SESSION['EXAM_PAPER_ID'];
}
 

 $selectNumberMistakes = "SELECT * FROM detectexam WHERE examid='$examID' AND studentID='$studentid'";
$selectNumberMistakes_run = mysqli_query($conn, $selectNumberMistakes);

if (mysqli_num_rows($selectNumberMistakes_run) == 0){
  $insertmistakes = "INSERT INTO detectexam(studentID,examid,subjectid,batchid) values('{$studentid}','{$examID}','{$subjectID}','{$studentbatch}')";
  $insertmistakes_run = mysqli_query($conn, $insertmistakes);
}else{
  $selectNumberMistakes = "SELECT * FROM detectexam WHERE examid='$examID' AND studentID='$studentid'";
  $selectNumberMistakes_run = mysqli_query($conn, $selectNumberMistakes);
  $getdata = mysqli_fetch_assoc($selectNumberMistakes_run);
}
 




  $newdata = $_POST['newdata'];
if($newdata =='visible'){

    $num= $getdata['mistakes']+1;

  $updateMistakes = "UPDATE detectexam SET mistakes='$num'  WHERE examid='{$examID}' AND studentID='{$studentid}' ";
  $insertmistakes_run = mysqli_query($conn, $updateMistakes);


    if($insertmistakes_run ==true){
        echo "<small class='hswotheerror'>You are trying to do something</small>";
    }

} 
?>