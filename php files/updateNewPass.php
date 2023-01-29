<?php 
include("databaseconn.php");
session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
 header("location:../index.php");
}else{
      $studentID = $_SESSION['studentID'];
}
$newpass = $_POST['newpass'];
$newpassAgain = $_POST['newpassAgain'];


if(strlen($newpass) <=4 && strlen($newpassAgain)<=4){
    echo ' <div class="alert alert-danger" role="alert">
     Password is too short
</div>';
}
else if ($newpassAgain !== $newpass){
    echo ' <div class="alert alert-danger" role="alert">
     Passwords not matching
</div>';
}
else{
    $updateSQL = "UPDATE student SET password='$newpassAgain' WHERE studentID='$studentID'";
    $updateSQL_run = mysqli_query($conn, $updateSQL);

    if($updateSQL_run){
        echo ' <div class="alert alert-success" role="alert">
     Updated
</div>';

echo "<script>window.location.href='settingpage.php'</script>";
    }{
        
    }
} 

?>