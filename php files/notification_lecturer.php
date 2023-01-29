

<?php 

include("databaseconn.php");
session_start();
 
include_once("lectetrSESSION.php");
if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
}




$lecturerID = $_SESSION['lectureID'];
  $SUBJECT =$_SESSION['subjectID_new'];
$lectureclass = $_SESSION['teacherClassID'];

  $batchID = $_SESSION['batchID_new'];


$sql = "SELECT * FROM teacherclassnotification WHERE teacherID='$lecturerID' AND teacherclassID='$lectureclass' AND subjectID='$SUBJECT'";
$query = mysqli_query($conn,$sql);
 



 




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifications</title>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
 
    <?php include("boostrap.php")?>
<style>
 .addsubject{
            position: fixed;
            right: 25px;
            top: 65px;
            z-index: 100;
            
            
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
        .reply_Section{
          display: none;
        }
</style>
</head>
<body>
<?php include("innerpreloader.php");?>

<?php include("lecturer_header.php")  ?>

<?php include("my_students_nav.php")  ?>


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


<div class="py-5">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">


  
                          


                            <?php 
                            
                            if(mysqli_num_rows($query) ==  0)
                            {
                              ?>
<center>
                        <img src="../images/undraw_new_message_re_fp03.svg" alt="" srcset="" style="width: 350px; height: 350px; margin-top: 30px;">

                        <p class="mt-3">No notifications yet </p>
                        </center>
<?php
                            }else
                            {
                              while($rowdata = mysqli_fetch_assoc($query))
                              {
                                ?>
                                <div class="card">

                                <div class="card-header">
                                <h6>Posted Notificatios</h6>
                            </div>

                            <div class="card-body">
                            <hr>

                            <div class="comment_container">

                  <div class="reply_box border p-2 mb-2">
                <h6 class="username"><small>Posted By : Me</small> </h6>
                <p class="para"> <?php echo $rowdata['content'];?></p>
                <button value ="<?php echo $rowdata['teacherClassNotifiID'];?>"  class="badge btn btn-warning reply_btn" id="replaybtn">See Replayes</button>
                
                <div class="ml-4 reply_Section">
                    dwadawd
                             
             </div>
                 
       </div>










<?php
                              }
                            }
                            ?>

                            </div>
                             </div>

      </div>
      </div>


      </div>

      </div>

      </div>

 

      <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>
  function addDarkmodeWidget() {
    new Darkmode().showWidget();
  }
  window.addEventListener('load', addDarkmodeWidget);
</script>

<script type="text/javascript"> 
    const options = {
  bottom: '64px', // default: '32px'
  right: 'unset', // default: '32px'
  left: '32px', // default: 'unset'
  time: '0.5s', // default: '0.3s'
  mixColor: '#fff', // default: '#fff'
  backgroundColor: '#fff',  // default: '#fff'
  buttonColorDark: '#100f2c',  // default: '#100f2c'
  buttonColorLight: '#ffff54', // default: '#fff'
  saveInCookies: true, // default: true,
  label: '🌓', // default: ''
  autoMatchOsTheme: true // default: true
}

const darkmode = new Darkmode(options);
darkmode.showWidget();

 
</script>

<script type="text/javascript" src="sendingID.js"></script>
</body>
</html>