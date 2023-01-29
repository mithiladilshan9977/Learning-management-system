<?php 
 include("databaseconn.php");



$catId = $_POST['catId'];
$sql = "SELECT * From file WHERE fileID= $catId";
$result= mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$status = $data['filestatus'];

if($status == '0'){
    $status = '1';
}else{
    $status = '0';
}

$update = "UPDATE file SET filestatus='$status' WHERE fileID=$catId "; 
$result1= mysqli_query($conn, $update);
if($result1){
    echo $status;
}

?>