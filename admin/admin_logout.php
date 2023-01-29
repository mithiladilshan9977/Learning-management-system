<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }
include("dbconection.php");
$theadminname = $_SESSION['AId'];
$sql = "UPDATE adminlogs SET logoutdate = NOW() WHERE adminID = '$theadminname'";

 
$query = mysqli_query($conn , $sql);
session_destroy();
echo "<script> window.location.href='index.php' </script>"
?>