<?php

include("databaseconn.php");
session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
 header("location:../index.php");
}
$noteID = $_POST['theupdatbtnval'];

$sqlectnoteSQL = "SELECT * FROM studentsnotes WHERE noteid='$noteID'";
$sqlectnoteSQL_run = mysqli_query($conn, $sqlectnoteSQL);
$newrowdata = mysqli_fetch_assoc($sqlectnoteSQL_run);
echo $note = $newrowdata['note'];

?>