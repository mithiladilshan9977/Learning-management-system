<?php 

include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}else{
   $studentbatch = $_SESSION['STUDENTBATCH'];
   $studentid = $_SESSION['subjectID'];
    $examid = $_SESSION['EXAM_PAPER_ID'];
}

echo $password = $_POST['thepassword'];

$selectExam = "SELECT * FROM examinformation WHERE examPaperID='{$examid}'";
$selectExam_run = mysqli_query($conn, $selectExam);
$getdata = mysqli_fetch_assoc($selectExam_run);
$passowrdSaved = $getdata['password'];

if($password !==$passowrdSaved)
{
    echo '<div class="alert alert-danger" role="alert">
   Password is not correct
  </div>';
}
else
{?>

<script>
    window.location.href='endOfPaper.php?examPaperID=<?php echo  $examid?>';
</script>
<?php
    
}


?>