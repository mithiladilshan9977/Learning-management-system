<?php 
include("dbconection.php");
 
$batchID = $_POST['batchID'];
  $BatchName = $_POST['BatchName'];

  if(!$BatchName){
    echo '<div class="alert alert-danger" role="alert">
   Enter record
  </div>';
  }else{
    $sql = "UPDATE batch SET NameOfBatch='$BatchName' WHERE BatchID='$batchID'";
    $query = mysqli_query($conn, $sql);

    echo '<script>swal("Good job!", "Updated Succesfully", "success")</script>';
  }

?>