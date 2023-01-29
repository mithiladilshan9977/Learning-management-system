<?php 
include("databaseconn.php");
session_start();
  // require("lectetrSESSION.php");

if (!isset($_SESSION['lectureID'])) {
    header("location:../index.php");
    die();

}
else{
      $lecid = $_SESSION['lectureID'];
}


$currentpass = $_POST['currentPass'];
$newPass = $_POST['newPass'];
$newPassAgain = $_POST['newPassAgain'];

if(strlen($newPass) <=4)
{
    ?>
<div class="alert alert-danger" role="alert">
   Password is too short
</div>
    <?php

}else if ($newPassAgain !== $newPass)
{
    ?>

<div class="alert alert-danger" role="alert">
   Passwords Not Matching
</div>
<?php
}
else{

    echo '<div class="alert alert-success" role="alert">
Updated

</div>';

    $updatePassSQL = "UPDATE lecture SET password='$newPass' WHERE lectureID='$lecid'";
$updatePassSQL_run = mysqli_query($conn, $updatePassSQL);
if($updatePassSQL_run == true){
        echo "<script>window.location.href='lecturer_settingpage.php'</script>";
}

}

 




?>