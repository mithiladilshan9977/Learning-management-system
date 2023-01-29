<?php 
include("dbconection.php");



$catId = $_POST['catId'];
$sql = "SELECT * From batch WHERE BatchID= $catId";
$result= mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$status = $data['status'];

if($status == '0'){
    $status = '1';
}else{
    $status = '0';
}

$update = "UPDATE batch SET status='$status' WHERE BatchID=$catId "; 
$result1= mysqli_query($conn, $update);
if($result1){
    echo $status;
}

?>