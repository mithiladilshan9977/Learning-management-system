<?php 

include("databaseconn.php");
session_start();
 // require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
 header("location:../index.php");
}
$noteID = $_POST['thenoteID'];
 
$updatSQL = "UPDATE studentsnotes SET shownote='1' WHERE noteid='$noteID'";
$updatSQL_run = mysqli_query($conn, $updatSQL);

if($updatSQL_run)
{
    echo '<script>swal("Go - Xm", "Note is removed") 
    setTimeout(goback , 80);
    function goback(){ window.location.href="student_class.php";};
    
     
    </script>';
}
?>