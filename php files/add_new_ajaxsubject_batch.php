<?php    
echo '<script>swal("Good job!", "You clicked the button!", "success")</script>';
include("databaseconn.php");
session_start();
  $selectedbatch = $_POST['selectedbatch'];
  $selectedsubject = $_POST['selectedsubject'];
 $BatchID = $_POST['BatchID'];
  $subjectID = $_POST['subjectID'];
  $lecturerID = $_SESSION['lectureID'] ;




$sql = "INSERT INTO teacherclass(teacherID,batchID,subjectID,thubnails) VALUES('$lecturerID' , '$BatchID' , '$subjectID' , '../images/classroom.png')";
$query = mysqli_query($conn , $sql);


$teacherClass = mysqli_query($conn , "SELECT * FROM teacherclass ORDER BY teacherClassID");
$teacherRow = mysqli_fetch_array($teacherClass);
$teacherID = $teacherRow['teacherClassID'];

$insertQuery = mysqli_query($conn,"SELECT * FROM student WHERE batchID='$BatchID '");
while($newrow = mysqli_fetch_array($insertQuery)){
  $id=$newrow['studentID	'];
  mysqli_query($conn , "INSERT INTO teacherbatchstudent(teacherrID , teachstudeID,teacherBatID) VALUES('$lecturerID','$id','$teacherID')");
 
}






?>