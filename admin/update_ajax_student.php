<?php 
include("dbconection.php");


$studentID = $_POST['studentID'];
$stuFname = $_POST['stuFname'];
$stuLname = $_POST['stuLname'];
$indexnumber = $_POST['indexnumber'];
$selectstudentbatch = $_POST['selectstudentbatch'];


$newindexnuber = ltrim($indexnumber);



 

$sql = "UPDATE student SET firstname='$stuFname' , lastname='$stuLname' , batchID='$selectstudentbatch' , indexnumber='$newindexnuber' WHERE studentID='$studentID '";
$query = mysqli_query($conn , $sql);


echo '<script>swal("Good job!", "Updated Succesfully", "success")</script>';

?>