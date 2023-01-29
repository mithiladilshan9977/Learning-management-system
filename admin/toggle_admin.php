<?php 
include("dbconection.php");



$catId = $_POST['catId'];
$sql = "SELECT * From adminn WHERE AId= $catId";
$result= mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$status = $data['status'];

if($status == '0'){
    $status = '1';
}else{
    $status = '0';
}

$update = "UPDATE adminn SET status='$status' WHERE AId=$catId "; 
$result1= mysqli_query($conn, $update);
if($result1){
    echo $status;
}

?>