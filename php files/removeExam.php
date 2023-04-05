<?php



include("databaseconn.php");
session_start();
  require("lectetrSESSION.php");
 
if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}

$examID = $_POST['theexamid'];
$selectexam = "DELETE  FROM examinformation WHERE examPaperID='{$examID}'";
$selectexam_run = mysqli_query($conn, $selectexam);
 
$selectexamquestion = "DELETE  FROM question WHERE examPaperID='{$examID}'";
$selectexam_runquestions = mysqli_query($conn, $selectexamquestion);


$oprionsdelete = "DELETE  FROM questionoptions WHERE examPaperID='{$examID}'";
$oprion_run = mysqli_query($conn, $oprionsdelete);

$removeselectedQUestions = "DELETE  FROM questionselected WHERE examPaperID='{$examID}'";
$removeselectedQUestions_run = mysqli_query($conn, $removeselectedQUestions);


if($removeselectedQUestions_run == true)
{
    echo '<script>swal("REMOVED", "Good Work !") 
    setTimeout(goback , 1000);
    function goback(){ window.location.href="addExamPpaer.php";};
  </script>';
}








?>