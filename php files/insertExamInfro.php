<?php



include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
    $lecID = $_SESSION['lectureID'];
    $batchID = $_SESSION['batchID_new'];
    $subjectID = $_SESSION['subjectID_new'];

}

$examName = $_POST['nameofpaper'];
$timeInHours = $_POST['timeInHours'];
$timeInMinutes = $_POST['timeInMinutes'];
$closesPassword = $_POST['closesPassword'];
$startPassword = $_POST['startPassword'];

 
$limiteToquestions = $_POST['limitTo'];


if(empty($examName) || empty($timeInMinutes) || empty($closesPassword) || empty($startPassword)  )
{
  echo '<div class="alert alert-danger" role="alert">
  Please fill the form !
</div>';
}
 
else if(empty($closesPassword) )
{
  echo '<div class="alert alert-danger" role="alert">
     Enter close exam password !
  </div>';
}
else if(empty($startPassword) )
{
  echo '<div class="alert alert-danger" role="alert">
     Enter start exam password !
  </div>';
}

else {

  $insertSQL = "INSERT INTO examinformation (batchID,lecturID,subjectID,hoursnew,minutesnew,startpassword,password,paperName,limitTo)VALUES('$batchID','$lecID','$subjectID','$timeInHours','$timeInMinutes','$startPassword','$closesPassword','$examName','$limiteToquestions')";
  $insertSQL_run = mysqli_query($conn, $insertSQL);
  
  if($insertSQL_run){
      echo '<script>swal("You are almost done", "Well Done !") 
      setTimeout(goback , 2000);
      function goback(){ window.location.href="addExamPpaer.php";};
      
       
      </script>';
  }else{
      echo '<div class="alert alert-danger" role="alert">
       Error occured
    </div>';
  }
}










?>