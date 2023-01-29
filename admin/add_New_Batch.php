<?php 

include("dbconection.php");
 
  $batchname = $_POST['bathcname'];

  if(!$batchname){

    echo 'no';

  }else{

    $sql="INSERT INTO batch(NameOfBatch) VALUES ('$batchname')";
    $query = mysqli_query($conn,$sql);

    echo '<script>swal("Good job!", "Successfully added", "success")</script>';
   
 
  }
   

?>