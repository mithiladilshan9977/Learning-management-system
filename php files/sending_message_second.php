<?php 

include("databaseconn.php");
session_start();
if (isset($_POST['sendbtn'])) {

       $notificationID = $_SESSION['notificationID'].'<br>';
      $studentID = $_SESSION['studentID'].'<br>';
      $batchID = $_SESSION['batchIDnew'].'<br>';
      $subjectID = $_SESSION['subjectID'].'<br>';
      $replqyingmessagetext = $_POST['replqyingmessagetext'];

   $sql = "INSERT INTO replyedmessage(replyText,teacherclassNotificatID,studentID,batchID,subjectID)values ('$replqyingmessagetext','$notificationID','$studentID','$batchID','$subjectID')";
   $query = mysqli_query($conn, $sql);
   if($query){
        echo "<script>
         setTimeout(goback , 3000);
function goback(){
    window.location.href='student_notifications.php';
}
        
        
        </script>";



        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include("boostrap.php")?>
    <style>
        .container{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 60vh;
        }
        #preloader{
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../images/preloader.gif" alt="" id="preloader">
        <br>
        <p>Sending ...</p>
    </div>
</body>
</html>
        <?php

}else{
        echo '<div class="alert alert-danger" role="alert">
    There is a problem while sending...
  </div>';
}



}

?>


