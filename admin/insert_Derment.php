<?php  
 

$Department = $_POST['Department'];
$PersoneIncgarge = $_POST['PersoneIncgarge'];

include("dbconection.php");


if(!$Department || !$PersoneIncgarge){
    echo '<div class="alert alert-danger" role="alert">
     Enter Records
    </div>';
}else{
    $sql="INSERT INTO deprtment(departmentName,dean) VALUES ('$Department' , '$PersoneIncgarge')";
    $query = mysqli_query($conn , $sql);

    echo'<script>swal("Good job!", "Successfully Inserted", "success");</script>';
}

?>