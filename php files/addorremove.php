<?php
session_start();
include("databaseconn.php");
$studentID = $_POST['theStudentID'];
$batchID = $_SESSION['batchID_new'];
          
 

$newaddSQl = "SELECT student.*, batch.* FROM student LEFT JOIN batch ON student.batchID = batch.BatchID WHERE batch.BatchID='$batchID' AND student.studentID='$studentID'";
$newaddSQl_run = mysqli_query($conn, $newaddSQl);

$getCurrentStatus = mysqli_fetch_assoc($newaddSQl_run);
$currentState = $getCurrentStatus['remoneAdd'];
$setupdate;
if($currentState == '0'){
    $setupdate = '1';
}else{
    $setupdate = '0';
}
 
$updateSQl = "UPDATE student SET remoneAdd='$setupdate' WHERE studentID='$studentID'" ;
$updateSQl_run = mysqli_query($conn, $updateSQl);

if  ($updateSQl_run)
{
    
    echo '<script>swal("SUCCESSED", "Student Updated") ;
    
    
     
    </script>';
}else   {
    echo '<script>swal("FAILED", "Something went wrong") ;
     
    
     
    </script>'; 
}

?>