<?php 
include("dbconection.php");



$catId = $_POST['catId'];
$sql = "SELECT * From lecture WHERE lectureID= $catId";
$result= mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$status = $data['lectstatus'];

if($status == '0'){
    $status = '1';
}else{
    $status = '0';
}

$update = "UPDATE lecture SET lectstatus='$status' WHERE lectureID=$catId "; 
$result1= mysqli_query($conn, $update);
if($result1){
    echo $status;
}

?>