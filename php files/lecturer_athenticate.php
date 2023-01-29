<?php 

include("databaseconn.php");

 
$firstnmae = $_POST['firstnmae'];
$lastname = $_POST['lastname'];
$selectdepartment = $_POST['selectdepartment'];
$password = $_POST['password'];
$reenterpassword = $_POST['reenterpassword'];
$username = $_POST['username'];


 
if(!$firstnmae || !$lastname){
    echo '<div class="alert alert-danger" role="alert">
    Please Enter Your Name
  </div>';
}
elseif(!$selectdepartment){
    echo '<div class="alert alert-danger" role="alert">
    Please Enter Your Batch
  </div>';
}
elseif(!$password){
    echo '<div class="alert alert-danger" role="alert">
    Please Enter a Password
  </div>';
}
elseif(!$reenterpassword){
    echo '<div class="alert alert-danger" role="alert">
    Please Enter a Password 
  </div>';
}


elseif($password != $reenterpassword){
    echo '<div class="alert alert-danger" role="alert">
    Passwords Not Matching
  </div>';
}elseif(strlen($passowrd)<=3){
  echo '<div class="alert alert-danger" role="alert">
    Password is too short
  </div>';
}else{
     
    $newsql = "SELECT * FROM lecture WHERE firstname='$firstnmae' AND lastname='$lastname' AND  departmentID='$selectdepartment'";
    $newqury = mysqli_query($conn,$newsql) or die(mysqli_errno());

    
    $newdata = mysqli_fetch_array($newqury);
try{

  if(!$newdata){
    throw new Exception("Error Processing Request", 1);
    
  }
  $id = $newdata['lectureID'];
}catch(Exception $e){
  echo '<div class="alert alert-danger" role="alert">
  Please Enter Right Information
</div>';
};

    
    
    $count = mysqli_num_rows($newqury);
    if($count > 0){
       $updatesql = "UPDATE lecture SET username='$username' , password = '$password', registeredONot='Registered' WHERE lectureID='$id'";
       $updatequery = mysqli_query($conn , $updatesql) or die(mysqli_errno());

       $_SESSION['studentID'] = $id;
       echo '<script>swal("Good job!", "Resgistration Completed.Now You Can Log In to Go - Xm", "success")</script>';
          
      
      
    }
}


?>