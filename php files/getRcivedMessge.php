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

$selectmessgeSQLlll = "SELECT student.studentID , student.imagepath,studentchat.* FROM student RIGHT JOIN studentchat ON studentchat.senderStudentid = student.studentID WHERE studentchat.reciverstudentid='{$studentid}' AND studentchat.senderStudentid='{$reciverid}'";
$selectmessgeSQL_runnn = mysqli_query($conn, $selectmessgeSQLlll);

 
while($fetchSenifnMesshes = mysqli_fetch_assoc($selectmessgeSQL_runnn))

{
    ?>
    <div class="container"  >
  <div class="outgoing-chats"> 
                  

                  <div class="outgoing-chats-msg">
                    <div class="outgoing-msg-inbox">
                     <p><?php echo $fetchSenifnMesshes['message'];?></p>
                     <span class="time"><?php echo $fetchSenifnMesshes['date'];?></span>
                    </div>
                  </div>
                  <div class="outgoing-chats-img">
                     <img class="img-thubnail img" src="<?php echo $fetchSenifnMesshes['imagepath'];?>" alt="">
                  </div>
            </div>
            </div>

<?php
}

?>
