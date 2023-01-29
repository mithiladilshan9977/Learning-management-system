<?php 

include("dbconection.php");
session_start();
$selectdepartment = $_SESSION['DEPERTMENTID'];
$LectFirstName = $_POST['LectFirstName'];
$LectLastName = $_POST['LectLastName'];
 
$sql = "INSERT INTO lecture (firstname , lastname ,departmentID ) VALUES ('$LectFirstName' , '$LectLastName', '$selectdepartment' )";
$query = mysqli_query($conn , $sql);

echo'<script>swal("Good job!", "Successfully Inserted", "success")</script>';

?>