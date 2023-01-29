<?php 
 include("databaseconn.php");
 session_start();
 if(!isset($_SESSION['studentID'] )){
    header("location:../index.php");
  }

$thenote = $_POST['thenote'];
$studentID = $_SESSION['studentID'];

$insertSQl = "INSERT INTO studentsnotes(studentid,note) VALUES('$studentID' ,'$thenote' )";
$insertSQl_run = mysqli_query($conn, $insertSQl);

if($insertSQl_run)
{
    echo '<script>swal("Note Added") 
    setTimeout(goback , 500);
    function goback(){ window.location.href="student_class.php";};
    
     
    </script>';
}

?>