<?php 

include("databaseconn.php");

$indexnumber =  mysqli_real_escape_string($conn , $_POST['indexnumber']) ;
$firstnmae = mysqli_real_escape_string($conn ,$_POST['firstnmae'] );
$lastname = mysqli_real_escape_string($conn , $_POST['lastname']);
$selectbatch = mysqli_real_escape_string($conn ,$_POST['selectbatch'] );
$password = mysqli_real_escape_string($conn , $_POST['password']);
$reenterpassword = mysqli_real_escape_string($conn ,$_POST['reenterpassword'] );

if(!$indexnumber){
    echo '<div class="alert alert-danger" role="alert">
     Please Enter Your Index Number
  </div>';
}
elseif(!$firstnmae || !$lastname){
    echo '<div class="alert alert-danger" role="alert">
    Please Enter Your Name
  </div>';
}
elseif(!$selectbatch){
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
}
elseif(strlen($password)<=3){
  echo '<div class="alert alert-danger" role="alert">
    Password is too short
  </div>';
}
else{
     
    $newsql = "SELECT * FROM student WHERE indexnumber='$indexnumber' AND firstname='$firstnmae' AND lastname='$lastname' AND  batchID='$selectbatch'";
    $newqury = mysqli_query($conn,$newsql) or die(mysqli_errno());

    
    $newdata = mysqli_fetch_assoc($newqury);


    try{
      if(!$newdata){
               throw new Exception("Error Processing Request", 1);
               
      }

      $id = $newdata['studentID'];
    }catch(Exception $e){
      echo '<div class="alert alert-danger" role="alert">
      Please Enter Right Information
   </div>';
    }

    

    $count = mysqli_num_rows($newqury);
    if($count > 0){
       $updatesql = "UPDATE student SET password='$password' , status='Registered' WHERE studentID='$id'";
       $updatequery = mysqli_query($conn , $updatesql) or die(mysqli_errno());

       $_SESSION['studentID'] = $id;
       echo '<script>swal("Good job!", "Resgistration Completed.Now You Can Log In to Go - Xm", "success")</script>';
          
      
      
    }
}


?>