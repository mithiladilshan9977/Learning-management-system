<?php
 
 include("databaseconn.php");
 
 

 $catId = $_POST['catId'];



$deletedSQL_new = "SELECT teacherclass.*,batch.*,subject.* FROM teacherclass LEFT JOIN batch ON teacherclass.batchID = batch.BatchID LEFT JOIN subject ON subject.subjectId = teacherclass.subjectID WHERE teacherID='$catId' AND classstatus='1'";

 


$result= mysqli_query($conn, $deletedSQL_new);
$data = mysqli_fetch_assoc($result);

echo $status = $data['classstatus'];
 


if($status == '0'){
    $status = '1';
}else{
    $status = '0';
}



$update_sql = "UPDATE teacherclass SET classstatus = '$status' WHERE teacherClassID = '$catId'";
$update_query = mysqli_query($conn, $update_sql);
if($update_query){
    echo $status;
}


?>