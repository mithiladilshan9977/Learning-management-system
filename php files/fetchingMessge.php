<?php 
 include("databaseconn.php");
 session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
  header("location:../index.php");
}
else{
  $studentid = $_SESSION['studentID'];
 
}
$reciverid = $_POST['reciverID'];

$selectmessgeSQL = "SELECT student.studentID , student.imagepath,studentchat.* FROM student RIGHT JOIN studentchat ON studentchat.senderStudentid = student.studentID WHERE studentchat.senderStudentid='{$studentid}' AND studentchat.reciverstudentid='{$reciverid}'";
 
$selectmessgeSQL_run = mysqli_query($conn, $selectmessgeSQL);



while($fetchSenifnMesshes = mysqli_fetch_assoc($selectmessgeSQL_run))

{
    ?>

    <div class="container"  >
<div class="received-chats"> 
                  <div class="recevied-chats-img">
                     <img  class="img-thubnail img" src=" <?php echo $fetchSenifnMesshes['imagepath']; ?>" alt="">
                  </div>

                  <div class="received-msg">
                    <div class="recevied-msg-inbox">
                     <p><?php echo $fetchSenifnMesshes['message']; ?></p> <img  class=""  src="../images/three_dots_c3qkzsqcpe34.svg" alt="" srcset="" style="width: 20px; height: 20px; cursor: pointer;">
                     <span class="time"><?php echo $fetchSenifnMesshes['date']; ?> </span>
                    </div>
                  </div>
            </div>
            </div>

<?php
}

?>
