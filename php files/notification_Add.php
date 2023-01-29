<?php 

include("databaseconn.php");
session_start();
error_reporting(0);

  $teacher_class_id = $_SESSION['teacherClassID'];
  $lecturerID = $_SESSION['lectureID'];
  $nofificationmassage = $_POST['nofificationmassage'];
  $SUBJECT =$_SESSION['subjectID_new'];
  $studentBatch = $_SESSION['batchID_new'];

if(isset($_POST['nitifybtn'])){

    $sql = "INSERT INTO teacherclassnotification(content,teacherID,teacherclassID,subjectID,btachID,date) VALUES ('$nofificationmassage','$lecturerID' , '$teacher_class_id' ,'$SUBJECT' ,'$studentBatch', NOW() )";
    
    $query = mysqli_query($conn, $sql);
  mysqli_query($conn, "INSERT INTO notifications(teacherClassID,notification,date,link) VALUES('$teacher_class_id' ,'Add Annoucements',NOW() , 'announcements_student.php' )");

    echo '<script>window.location.href="notification_lecturer.php?"</script>';
    
}

?>