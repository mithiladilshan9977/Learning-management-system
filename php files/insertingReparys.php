<?php 
 include("databaseconn.php");
 session_start();


  
 $studentID = $_SESSION['studentID'];
 $subjectID = $_SESSION['subjectID'];

  $reaplymessag = mysqli_real_escape_string($conn, $_POST['commecnt_text_box']);
  $notificationID = $_POST['ClickeBtnValue'];


 $sql = "SELECT * FROM student WHERE studentID='$studentID'";
 $query = mysqli_query($conn, $sql);

   $data = mysqli_fetch_assoc($query);
   $batch = $data['batchID'];

$newsql = "INSERT INTO studentreplays(studentID,subjectID,batchID,teacherNotificationID,messagetext)VALUES('$studentID','$subjectID','$batch','$notificationID','$reaplymessag')";
$newsql_run = mysqli_query($conn, $newsql);



 ?>