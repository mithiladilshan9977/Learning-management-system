<?php    

include("databaseconn.php");
session_start();
 
  $selectedbtach_new_new = $_POST['selectedbatch'];
  $selectedsubject_new_new = $_POST['selectedsubject'];
  $lecturerID = $_SESSION['lectureID'] ;

$getimageSQL = "SELECT * FROM teacherclass WHERE teacherID='{$lecturerID}'";
$getimageSQL_run = mysqli_query($conn, $getimageSQL);
$gettinddate = mysqli_fetch_assoc($getimageSQL_run);
$tubmainID = $gettinddate['thubnails'];
 
 
if($tubmainID == 0){
  $imageURL = "1";
}else{
  $imageURL = $tubmainID  ;
}
 
 


  $sql = "INSERT INTO teacherclass(teacherID,batchID,subjectID,thubnails) VALUES('$lecturerID' , '$selectedbtach_new_new' , '$selectedsubject_new_new' , '$imageURL')";
  $query = mysqli_query($conn , $sql);


  $teacherClass = mysqli_query($conn , "SELECT * FROM teacherclass ORDER BY teacherClassID DESC");
$teacherRow = mysqli_fetch_array($teacherClass);
$teacherID = $teacherRow['teacherClassID'];


  $insertQuery = mysqli_query($conn,"SELECT * FROM student WHERE batchID='$selectedbtach_new_new '");
  while($newrow = mysqli_fetch_array($insertQuery)){
    $id=$newrow['studentID'];
    mysqli_query($conn , "INSERT INTO teacherbatchstudent(teacherrID , teachstudeID,teacherBatID) VALUES('$lecturerID','$id','$teacherID')");
   
  }
  if($insertQuery = true){
    echo '<script>swal("Batch is added", "Good job !") 
    setTimeout(goback , 1000);
    function goback(){ window.location.href="lecturer_class.php";};
  </script>';
  }
  




  
 
 


?>