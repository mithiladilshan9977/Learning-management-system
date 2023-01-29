<?php 
include("databaseconn.php");



$catId = $_POST['catId'];
$sql = "SELECT * From teacherclass WHERE teacherClassID= $catId";
$result= mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$status = $data['classstatus'];

if($status == '0'){
    $status = '1';
}else{
    $status = '0';
}

$update = "UPDATE teacherclass SET classstatus='$status' WHERE teacherClassID=$catId "; 
$result1= mysqli_query($conn, $update);
if($result1){
    echo $status;
}

?>