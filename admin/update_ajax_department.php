<?php 
 

 include("dbconection.php");
 $depaermentID = $_POST['depaermentID'];
 $departmentName = $_POST['departmentName'];
 $dean = $_POST['dean'];


 if(!$departmentName || !$dean){
    echo '<div class="alert alert-danger" role="alert">
     Enter Detailes
  </div>';
 }else{

    $sql = "UPDATE deprtment SET departmentName='$departmentName' , dean='$dean' WHERE depaermentID = '$depaermentID'";
    $query = mysqli_query($conn , $sql);

    
    echo '<script>swal("Good job!", "Updated Succesfully", "success")</script>';
     
 }




 


?>