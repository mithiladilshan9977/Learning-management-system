<?php 
include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
  echo "<script>window.location.href = 'index.php'</script>";
  die();
}

$newPass = $_POST['newPass'];
$newPassAgain = $_POST['newPassAgain'];
$lectID = $_POST['lecID'];


if(strlen($newPassAgain) <=4){
    echo '<div class="alert alert-danger" role="alert">
    password is too short
  </div>';
}
else if ($newPassAgain !== $newPass){
    echo '<div class="alert alert-danger" role="alert">
      Passwords not matched
  </div>';
}
else{
    $updatequeru = "UPDATE  lecture SET password='$newPassAgain' WHERE lectureID='$lectID' ";
    $updatequeru_RUN = mysqli_query($conn, $updatequeru);
   
    echo '<script>swal("Updated Successfully", "Good job") 
      setTimeout(goback , 1500);
      function goback(){ window.location.href="lectures.php";};
      
       
      </script>';
}

?>