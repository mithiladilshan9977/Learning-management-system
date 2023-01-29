

<?php 

include("databaseconn.php");
session_start();
error_reporting(0);




$lecturerID = $_SESSION['lectureID'];
  $SUBJECT =$_SESSION['subjectID_new'];
$lectureclass = $_SESSION['teacherClassID'];

  $batchID = $_SESSION['batchID_new'];


$sql = "SELECT * FROM teacherclassnotification WHERE teacherID='$lecturerID' AND teacherclassID='$lectureclass' AND subjectID='$SUBJECT'";
$query = mysqli_query($conn,$sql);




$NotificationID = $_GET['NotiID'];
$newsql = "SELECT teacherclassnotification.*, replyedmessage.* FROM teacherclassnotification RIGHT JOIN replyedmessage ON replyedmessage.teacherclassNotificatID = teacherclassnotification.teacherClassNotifiID  WHERE teacherclassnotification.teacherClassNotifiID='$NotificationID'";

$newquery = mysqli_query($conn, $newsql);






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
 .addsubject{
            position: fixed;
            right: 25px;
            top: 65px;
            z-index: 100;
            
            
        }
        .container{
            margin-top: 70px;
            border: 2px solid rgba(0, 26, 255, 0.338);
            border-radius: 8px;
        }
        .dwadawd{
          border: none;
        }
        .sentmessagetitle{
          padding: 15px;
        }
        .messagebody{
          padding: 2px;
          background-color: rgba(0, 0, 0, 0.099);
          padding-left: 10px;
        }
        #dataimages{
          width: 20px;
          height: 20px;
          position: relative;
          margin-right: 15px;
          bottom: 3px;

        }
        .replyedmessagediv{
          background-color: beige;
        }
        #replayedtext{
           
            margin-left: 10px;
        }
</style>
</head>
<body>
<?php include("innerpreloader.php");?>

<?php include("lecturer_header.php")  ?>

<?php include("lecturer_naviga_bar.php")  ?>


<div class="container dwadawd">
    <button type="button" class="btn btn-success   addsubject" data-bs-toggle="modal" data-bs-target="#exampleModal">
   Add Notification
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="message">

    </div>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Notification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form action="notification_Add.php?" method="post">
 

        <label for="">What is your Notification?</label>
        <input class="form-control" type="text" name="nofificationmassage" placeholder="Write The Notification" aria-label="default input example" id=" " required>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"  name="nitifybtn">Notify</button>

        </form>
      </div>
    </div>
  </div>
</div>



</div>


<?php
if(mysqli_num_rows($query) == 0 ){
  echo '<div class="alert alert-danger container" role="alert">
  No Records Found
</div>'; 
}else

{


  while($rows = mysqli_fetch_assoc($query))
  {

    ?>


<div class="container">

<div class="messagehead">
  <h4 class="sentmessagetitle">Sent Message</h4>
  <p class="messagebody"><?php echo $rows['content'];?></p>
  <div class="sentdate">

   <img src="../images/date_pa3tsj9imt8t.svg" alt="" id="dataimages"> <small class="dateofsending"><?php echo $rows['date'];?></small>
  </div>

  <div class="replyedmessagediv">
 

   
<?php 
while($rowsnew = mysqli_fetch_assoc($newquery))
{
    ?>
    <p><?php echo $rowsnew['teacherclassNotificatID'];?></p>
<p id="replayedtext"><?php echo $rowsnew['replyText'];?></p>
    <?php
}


?>

 
 



    

  </div>
</div>

 
</div>




<?php

  }
}

?>
 
<script type="text/javascript" src="sendingID.js"></script>
</body>
</html>