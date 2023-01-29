<?php 
include("databaseconn.php");
session_start();
error_reporting(0);

  $username = $_POST['usernamenew'];
  $password = $_POST['passwordnew'];
 
 


$sql="SELECT * FROM student WHERE indexnumber='$username' AND password= '$password'";
$query = mysqli_query($conn, $sql) ;
$row = mysqli_fetch_assoc($query);
$row_num = mysqli_num_rows($query);


$sqlLec = "SELECT * FROM lecture WHERE username='$username' AND password= '$password' AND registeredONot='Registered'";
$queryLec= mysqli_query($conn , $sqlLec);
$rowLec = mysqli_fetch_assoc($queryLec);
$row_lect_num = mysqli_num_rows($queryLec);


if($rowLec['registeredONot'] == 'Unregistered')
{
  echo ' <div class="alert alert-danger" role="alert">
     Please go and register 
</div>';
}
else if($row_num > 0){
    $_SESSION['studentID'] = $row['studentID'];
    $_SESSION['STUDENTBATCH'] = $row['batchID'];
  $greenSQL = "UPDATE student SET greenicon='1' WHERE studentID='" . $_SESSION['studentID'] . "'";
  $greenSQL_run = mysqli_query($conn, $greenSQL);

  $_SESSION['SESSION_ACTIVE_TIME'] = time() + (40*100);
  echo '<script>swal("SESSION expire Alert", "You will be automatically logged out after 10 Minutes") 
  setTimeout(goback , 2000);
  function goback(){ window.location.href="php files/student_class.php";};
  
   
  </script>';
 
 
 
}else if($row_lect_num > 0){
    $_SESSION['lectureID'] = $rowLec['lectureID'];
  $_SESSION['DEPARTMENTID'] = $rowLec['departmentID'];

    $_SESSION['LECTUTR_SESSION_ACTIVE_TIME'] = time() + (40*100);
    echo '<script>swal("SESSION expire Alert", "You will be automatically logged out after 10 Minutes") 
    setTimeout(goback , 2000);
    function goback(){ window.location.href="php files/lecturer_class.php";};
  </script>';
   
  
}else{
    echo ' <div class="alert alert-danger" role="alert">
     Invalid Credentials
  </div>';
}

 


?>