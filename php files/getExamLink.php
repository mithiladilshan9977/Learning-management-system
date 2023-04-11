<?php 



include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");
error_reporting(0);
if(!isset($_SESSION['studentID'])){
  header("location:../index.php");
  die();
  
}
else{
    $subjectID = $_SESSION['subjectID'];
  $studentBatch = $_SESSION['STUDENTBATCH'];
}


$selectSQL = "SELECT * FROM examinformation WHERE batchID='{$studentBatch}' AND subjectID='{$subjectID}'";
$selectSQL_run = mysqli_query($conn, $selectSQL);

// if($status == 0)
// {
//   echo '<script>swal("Exam not started yet !", "Please wait") </script>';
// }else{
  
// }

if(mysqli_num_rows($selectSQL_run) ==0){
  echo '<script>swal("There is no Exam yet !", "You have to wait till lecturer push the Exam") </script>';
}
else
{while($getdata = mysqli_fetch_assoc($selectSQL_run))
  {
    ?>
<div class="container" style="width: 700px; margin-top: 60px;">
    <h3 class="my-2">Exam <img src="../images/exam_n9hq8nzxyh3s.svg" alt="" srcset="" style="width: 30px; height: 30px; margin-left: 10px;"></h3> 
     <input type="hidden" value="<?php echo $getdata['examPaperID']; ?>" class="inputvalue">
     <div class="showthealert"></div>

     <p  class="chechAvaibelExam" style=" cursor: pointer;"> <?php echo $getdata['paperName'];?></p>
     

    <a href="exam_Title_page.php?ExamPaperID=<?php echo $getdata['examPaperID']; ?> & ExamPaperName=<?php echo $getdata['paperName']; ?>" style="text-decoration: none;"></a> 
</div>
    <?php

  }
  
  
 
}
?>
<script src="chechAvaibelExam.js">

</script>

 