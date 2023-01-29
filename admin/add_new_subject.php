<?php 
session_start();
include("dbconection.php");

 $thecode = $_POST['thecode'];
 $subjectTitle = $_POST['subjecttitile'];
 $semester = $_POST['semester'];
 $descrition = $_POST['descrition'];

 if(!$thecode){

    echo '<div class="alert alert alert-danger" role="alert">
    Enter Code
  </div>';

 }elseif(!$subjectTitle){

    echo '<div class="alert alert alert-danger" role="alert">
    Enter Title
  </div>';

 }elseif(!$semester){

    echo '<div class="alert alert alert-danger" role="alert">
     Select Semetser
  </div>';

 }else{
   $departmentID = $_SESSION['DEPERTMENTID'];

    $sql = "INSERT INTO subject (depaermentID,code , title, semester , description) VALUES ('$departmentID','$thecode' , '$subjectTitle' , '$semester' , '$descrition')";
    $query = mysqli_query($conn , $sql);
    if( $query){

      echo '<script>window.location.href="subjects.php"</script>';
    }

  

 }


?>