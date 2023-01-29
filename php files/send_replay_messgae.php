<?php 
 include("databaseconn.php");
 session_start();
error_reporting(0);
$studentID = $_SESSION['studentID'];
$subjectID = $_SESSION['subjectID'];


$sql = "SELECT * FROM student WHERE studentID='$studentID'";
$query = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($query);
  $batch = $data['batchID'];


$sqlnew = "SELECT * FROM teacherclassnotification LEFT JOIN lecture ON teacherclassnotification.teacherID=lecture.lectureID  WHERE subjectID='$subjectID' AND btachID='$batch'";

$newquery = mysqli_query($conn, $sqlnew);

 


if(isset($_GET['notiID'])){
    $noticationID = $_GET['notiID'];
    $batchID = $_GET['btachID'];

}else{
    $noticationID = 1;
}


$_SESSION['notificationID'] = $noticationID;
$_SESSION['batchIDnew'] = $batchID;


 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
.container{
    margin-top: 50px;
    border: 2px solid black;
    width: 70%;
    border-radius: 10px;
    padding: 10px;
    transition: 0.2s all ease-in-out;
}
.container:hover{
    cursor: pointer;
    box-shadow: 1px 1px 15px 2px rgba(0, 0, 0, 0.416);
    transition: 0.2s all ease-in-out;
}
.msaagediv{
    background-color: rgba(0, 0, 0, 0.123);
    padding: 5px;
}
.postedDate{
    position: relative;
    margin-top: 5px;
    display: inline;
}
#dateimage{
    width: 20px;
    height: 20px;
    margin-left: 10px;
    transition: 0.2s all ease-in-out;
}
.container:hover #dateimage{
    transition: 0.2s all ease-in-out;
    transform: scale(1.5);
}
#anchortag{
    position: relative;
    margin-left: 10px;
    text-decoration: none;
 
}
.replymessagediv{
  
    position: relative;
    margin-left: 20px;
    margin-top: 7px;
}
#anchortag:hover{
   
     color: rgb(0, 31, 205);
}
.replaymessage{
    color: rgb(0, 31, 205);
}
    </style>
    <?php include("boostrap.php"); ?>
</head>
<body>
<?php include("innerpreloader.php");?>

<?php include("student_header.php")  ?>

<?php include("student_naviga_bar.php")  ?>


<?php 

if(mysqli_num_rows($newquery)==0){
    echo "No records found";
}else{
   while($rowsdata = mysqli_fetch_assoc($newquery))
   {?>

<div class="container">
    <p class="nameOfLecturer"><small>Posted By : </small> <?php echo $rowsdata['firstname'] .' ' .$rowsdata['lastname'] ?></p>
    <div class="  msaagediv">
           <p class="message"><?php echo $rowsdata['content']?></p>
    </div>
    <p class="postedDate"><?php echo $rowsdata['date'] ?><img src="../images/date_pa3tsj9imt8t.svg" alt="" id="dateimage"></p> <a href="send_replay_messgae.php?notiID=<?php echo $rowsdata['teacherClassNotifiID'];?> & teacherID=<?php echo $rowsdata['teacherID'];?>"  id="anchortag" data-bs-toggle="modal" data-bs-target="#exampleModal"><small>Replay</small> </a> To : <?php echo $rowsdata['firstname'] .' ' .$rowsdata['lastname'] ?>
    <div class="replymessagediv">
        <p class="replaymessage">Yes i can meet you there</p>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Send Reply Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  <form action="sending_message_second.php" method="post">
  <input class="form-control" type="text" placeholder="Write Message" aria-label="default input example" name="replqyingmessagetext" required>



      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="sendbtn">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>




</div>

<?php

   }


}



?>



</body>
</html>