<?php 
include("dbconection.php");

 
    $selectstudentbatch = $_POST['selectstudentbatch'];
    $indexnumber = $_POST['indexnumber'];
    $studentFName = $_POST['studentFName'];
    $StudentLname = $_POST['StudentLname'];

     $trimmedIndex = strtolower($indexnumber);

 
if(!$selectstudentbatch || !$indexnumber || !$studentFName || !$StudentLname){
    echo '<div class="alert alert-danger" role="alert">
    All Fields are required 
   </div> '     ;
}
 
    $sql  = "INSERT INTO student (firstname , lastname , batchID , indexnumber) VALUES ('$studentFName ' ,'$StudentLname ' ,  '$selectstudentbatch','$trimmedIndex' )";
    $newquery = mysqli_query($conn , $sql);


   


    echo'<script>swal("Good job!", "Successfully Inserted", "success")</script>'  ;
 
 


?>