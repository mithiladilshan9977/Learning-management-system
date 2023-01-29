<?php 
  include("databaseconn.php");
  session_start();
 // require("sessionTime.php");
 if(!isset($_SESSION['studentID'] )){
   header("location:../index.php");
 }
  

?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
  
    <?php include("boostrap.php"); ?>
  <title>Setting</title>
  <style>
    .good{
      color: green;
    }
    .bad{
      color: red;
    }
  </style>
 </head>
 <body>
 <?php include("innerpreloader.php");?>

<?php include("student_header.php")  ?>

<?php include("student_naviga_bar.php")  ?>

<div class="container mt-5" style="width: 900px;   padding: 5px;"> <h3>Settings</h3></div>

<div class="container mt-3" style="width: 500px;  border: 2px solid rgba(0, 0, 0, 0.267); padding: 5px;">

   <h6 class="mb-2">Preferences</h6>
   <hr>

   <a href="" style="text-decoration: none;"  data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</a>





   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Password Setting</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alertdiv"></div>
        <label for="">Current Password</label>  <small class="errorshow"></small>   <img src="../images/preloader.gif" class="preloader">
          <input type="text" class="form-control my-2" id="currentpassword" required>
          
          <label for="">New Password</label>
          <input type="password" class="form-control my-2" required id="newpassword">
          <label for="">New Password (again)</label> <small class="errorshowagain"></small>
          <input type="password" class="form-control my-2" required id="newAgainPass">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="changebtn">Change</button>
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
<script src="checkcurrentpassword.js"></script>
<script src="ckeckNewpassword.js"></script>
<script src="updatenewPsss.js"></script>
 </body>
 </html>
 