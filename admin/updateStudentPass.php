<?php
 include("dbconection.php");
session_start();
if(isset($_SESSION['STUDENT_ID'])){
    $newstudentID = $_SESSION['STUDENT_ID'];
}
$studentIndex = $_POST['studentIndex'];
$studentPassNew = $_POST['studentPassNew'];
$studentRepeatPass = $_POST['studentRepeatPass'];



$sql = "SELECT * FROM student WHERE studentID='$newstudentID'";
$newquery = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($newquery);
$data_indexnumber = $data['indexnumber'];
$bdindexnumber = strtolower($data_indexnumber);
$trimmed_index_number = strtolower($studentIndex);
$data_studentFname = $data['firstname'];
$data_studentLname = $data['lastname'];



 

if($trimmed_index_number !== $bdindexnumber){
    echo '<div class="alert alert-danger" role="alert">
  '.$data_studentFname.' '.$data_studentLname.' Index Number is Incorrect
  </div>';
}elseif(strlen($studentPassNew) <3){
    echo '<div class="alert alert-danger" role="alert">
    New Password Is Too Short
   </div>';
}elseif($studentPassNew !== $studentRepeatPass){
    echo '<div class="alert alert-danger" role="alert">
    New Password Is Not Matching
   </div>';
}else{
    $newsqlquery = "UPDATE student SET password='$studentPassNew' WHERE WHERE studentID='$newstudentID'";
    $newsql_run = mysqli_query($conn, $newsqlquery);
    echo '<div class="alert alert-success" role="alert">
     Updated
   </div>';
}


?>