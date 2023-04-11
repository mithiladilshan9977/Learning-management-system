<?php 

include("dbconection.php");
session_start();
$selectdepartment = $_SESSION['DEPERTMENTID'];
$LectFirstName = $_POST['LectFirstName'];
$LectLastName = $_POST['LectLastName'];
 
$sql = "INSERT INTO lecture (firstname , lastname ,departmentID ) VALUES ('$LectFirstName' , '$LectLastName', '$selectdepartment' )";
$query = mysqli_query($conn , $sql);

if( $query){
    echo '<script>swal("Lecturer added", "Successfully Inserted", "success")
    setTimeout(goback , 2000);
    function goback(){ window.location.href="lectures.php";};
  </script>';
 

  }
  

?>