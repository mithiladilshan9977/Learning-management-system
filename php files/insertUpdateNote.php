<?php 

include("databaseconn.php");
session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
 header("location:../index.php");
}
echo $updateText = $_POST['updateText'];
 
$sqlectTheText = "SELECT * FROM studentsnotes WHERE note='$updateText'";
$sqlectTheText_run = mysqli_query($conn, $sqlectTheText);
$getNoteID = mysqli_fetch_assoc($sqlectTheText_run);
echo $NoteID = $getNoteID['noteid'];

// $updatesql = "UPDATE studentsnotes SET note='$updateText'";
// $updatesql_run = mysqli_query($conn, $updatesql);

// if($updatesql_run){
  
// }


?>