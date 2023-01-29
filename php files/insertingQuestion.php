<?php



include("databaseconn.php");
session_start();
error_reporting(0);
// require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}
else{
    $lecID = $_SESSION['lectureID'];
    $examPaperID = $_SESSION['EXAM_PAPER_ID'];

}

$questionnumber =mysqli_real_escape_string($conn ,$_POST['questionnumber'] )  ;
$whatisQuestion = mysqli_real_escape_string($conn , $_POST['whatisQuestion']) ;
$correctNumber = mysqli_real_escape_string($conn , $_POST['correctNumber']) ;


$choice = array();

  $choice[1] = mysqli_real_escape_string($conn ,  $_POST['choice1']);
  $choice[2] =mysqli_real_escape_string($conn ,  $_POST['choice2']) ;
  $choice[3] = mysqli_real_escape_string($conn , $_POST['choice3']) ;
  $choice[4] = mysqli_real_escape_string($conn , $_POST['choice4']) ;
  $choice[5] = mysqli_real_escape_string($conn , $_POST['choice5']) ;


$insertQuesSQL = "INSERT INTO question(examPaperID,questionNumber,lectureID,questionText) VALUES ('{$examPaperID}','{$questionnumber}'  ,'{$lecID}','{$whatisQuestion}')";
$insertQuesSQL_run = mysqli_query($conn, $insertQuesSQL);

 if(empty($whatisQuestion) || empty($correctNumber)){
    echo '<div class="alert alert-danger role="alert"">
      Fields are empty !
    </div>'; 
 }
else if($insertQuesSQL_run) {
    foreach ($choice as $option => $value) {
        if($value !=""){
            if($correctNumber == $option)
            {
                $isCottect = 1;
            }
            else{
                $isCottect = 0;
            }
            $insertOptionsSQL = "INSERT INTO questionoptions(examPaperID,questionNumber,lectureID,options,is_correct) values('{$examPaperID}','{$questionnumber}' , '{$lecID}' , '{$value}' , '{$isCottect}')";
            $insertOptionsSQL_run = mysqli_query($conn, $insertOptionsSQL);

            if($insertOptionsSQL_run){
              
                continue;
            }else{
               echo  die("Error occured !");
            }

        }
    }
}else{
    echo "not insertted";
}
?>