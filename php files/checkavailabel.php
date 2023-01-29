<?php 


include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}
else{
    $subjectID = $_SESSION['subjectID'];
  $studentBatch = $_SESSION['STUDENTBATCH'];
}

$examid = $_POST['examID'];

$selectexam = "SELECT * FROM examinformation WHERE examPaperID='{$examid}'";
$selectexam_RUN = mysqli_query($conn, $selectexam);
$getdatanew = mysqli_fetch_assoc($selectexam_RUN);
 

if($getdatanew['status'] == 0){
    
    echo '<script>swal("Exam Not Started Yet !", "You have to wait till lecturer push the Exam") </script>';
}else
{?>
<script> 
window.location.href="exam_Title_page.php?ExamPaperID=<?php echo $getdatanew['examPaperID']; ?> & ExamPaperName=<?php echo $getdatanew['paperName']; ?>";
</script>
<?php

}


?>