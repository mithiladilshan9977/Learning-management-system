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
$repeatPassword = $_POST['repeatPassword'];
$limiteToquestions = $_POST['limitTo'];


if(empty($examName) || empty($timeInMinutes) || empty($closesPassword) || empty($repeatPassword)  )
{
  echo '<div class="alert alert-danger" role="alert">
  Please fill the form !
</div>';
}
else if(strlen($repeatPassword) <=4){
  echo '<div class="alert alert-danger" role="alert">
    Students May guess the password !
  </div>';
}
else if($closesPassword !==$repeatPassword)
{
  echo '<div class="alert alert-danger" role="alert">
     Passwords Not Matched !
  </div>';
}else {

  $insertSQL = "INSERT INTO examinformation (batchID,lecturID,subjectID,hoursnew,minutesnew,password,paperName,limitTo)VALUES('$batchID','$lecID','$subjectID','$timeInHours','$timeInMinutes','$closesPassword','$examName','$limiteToquestions')";
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