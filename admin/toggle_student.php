<?php 
include("dbconection.php");



$catId = $_POST['catId'];
$sql = "SELECT * From student WHERE studentID= $catId";
$result= mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$status = $data['oneandzero'];

if($status == '0'){
    $status = '1';
}else{
    $status = '0';
}

$update = "UPDATE student SET oneandzero='$status' WHERE studentID=$catId "; 
$result1= mysqli_query($conn, $update);
if($result1){
    echo $status;
}

?>