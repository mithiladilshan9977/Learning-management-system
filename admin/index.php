<?php
include("dbconection.php");

 
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Admin Log in</title>


          <?php include("boostrapJquery.php"); ?>


   
</head>
<style>
    *,*::after,*::before{
        padding: 0px;
        margin: 0px;
        box-sizing:  border-box;
    }
    :root{
        --bodybackgroundcolor: rgba(228, 228, 228, 0.444);
    }
    body{
        background-color: var(--bodybackgroundcolor);
    }
     
     
    #userpng{
        margin: 0px auto;
       display: block;
        position: relative;
     left: 80px;
        margin-bottom: 10px;
        width: 100px;
        height: 100px;
    }
    .container{
         display: flex;
      
     
         width: 450px;
         min-height: 400px;
         background-color: white;
         flex-direction: column;
       
    }
    .Gosigninpage{
        position: relative;
        float: right;
        top: 10px;
        right: 20px;
    }
    #showthemassage{
      width: 100%;
    }
    #pasword{
      margin-top: 5px;
      position: relative;
    }
    .bottom{
      position: absolute;
      bottom: 0px;
      width: 100vw;
      text-align: center;
      background-color: rgb(182, 182, 182);
    }
    .videowindow{
      border-radius: 15px;
  margin-top:10px;
    }
</style>
<body>
  <?php  include("admin_preloader.php") ;?>
<div id="showthemassage"> </div>
    <a href="Adminloginpage.php" class="btn btn-outline-primary Gosigninpage">I don't have an Account</a>
 

 
 <img src="../images/user.png" class="" alt="..." id="userpng">

 

 <center>
    <h1>Go - Xm Admin Log in</h1>
    <br>
 </center>

 




 <center>
  
    <div class="container" >

 
       <br>
      <label for="" mb-1><h4>User name</h4></label>
     
      <input class="form-control widthnew" id="theusername" type="text" placeholder="User name" aria-label="default input example"   name="username">
 
 
      <label for="" id="pasword" mb-1><h4>Password</h4></label>
     
      <input class="form-control widthnew" id="thepassword" type="text" placeholder="Password" aria-label="default input example"   name="password">
     
        <hr >
      <label for="" class="lables  my-1"><b>Log in as </b></label>
    

                        <select class="form-select" id="personnew">
                    
                            <option value="admin">Admin</option>person_signIn
                            <option value="coordinator">Coordinator</option>
                           
                            </select>

     <br>
    <button id="submitformee" class="btn btn-primary">Confirm</button>
    <button   class="btn btn-success mt-2" onclick="startScan()">Scan QR</button>
    <video id="preview" class="videowindow"></video>

 
    </div>
 </center>


 
 
     
 <!-- <div class="bottom">
 Saegis Campus Copyright &copy; All rights reserved | Developed and maintain by <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Mithila dilshan</a> 
    </div> -->
 

 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Developer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <img src="../images/studentimage.jpg" alt=""  class="img-thumbnail">

       
       <center>
        <label for=""><b>Name</b></label>
        <p>Mithila dilshan</p>
      
        <label for=""><b>E-mail</b></label>
        <p>dilshanwickramaarachchi@gmail.com</p>
   
        <label for=""><b>Batch</b></label>
        <p>BIT -2 </p>
       </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
 

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
 <script type="text/javascript">




let scanner = new Instascan.Scanner({ 
    video: document.getElementById('preview'), 
    scanPeriod: 1, 
    mirror: true 
  });

  scanner.addListener('scan', function (content) {
    alert("QR code is detected");
    document.getElementById("thepassword").value=content;
    
  });

  
function startScan() {
  Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      alert("No cameras found.")
      
    }
  }).catch(function (e) {
    
    console.error(e);
  });

}
 

 
  </script> 

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


 <script type="text/javascript" src="sendtheadmininfo_new.js"></script>


 
</body>





</html>