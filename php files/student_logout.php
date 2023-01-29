<?php 

 session_start();
session_destroy();
error_reporting(0);
include("databaseconn.php");
if(isset($_SESSION['studentID'])){
      $greeenicon = $_SESSION['studentID'];
}


$greenSQL = "UPDATE student SET greenicon='0' WHERE studentID='$greeenicon'";
  $greenSQL_run = mysqli_query($conn, $greenSQL);
echo '<script>window.location.href="../index.php?"</script>';


?>