 

<?php 
 include("databaseconn.php");
 
 
 if(isset( $_SESSION['studentID'])){
  $studentID = $_SESSION['studentID'];
 }else{
  echo "No session";
 }
$sql = "SELECT * FROM student WHERE studentID='$studentID'";
$new_query_run = mysqli_query($conn, $sql);
$datanew = mysqli_fetch_assoc($new_query_run);



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrap.php"); ?>
    <title>Document</title>
    <style>
         #navtitle{
        color: white;
    }
    .studentname{
      color: white;
      position: absolute;
   float: right;
   right: 80px;
    }
    .profileimageset{
      width: 50px;
      height: 50px;
     margin: 2px;
      border-radius: 50%;
   background-repeat: no-repeat;
   position: absolute;
   right: 280px;
      background-position: center;
    }
    .greenicon{
      position: absolute;
   right: 326px;
    top:10px;
   z-index: 50;
    }
    </style>
</head>
<body>
    
<nav class="navbar" style="background-color: rgba(0, 30, 255, 0.867)">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" id="navtitle">Go - Xm Student panel</a>
   <?php 
   if($datanew['imagepath'] =='../images/profile_0n4w2fa6t6a5.svg')
   {
    ?>
     <img src="../images/profile_0n4w2fa6t6a5.svg" alt="" class="profileimageset">
    <?php
   }else
   {
    ?>
    <img src="../images/pngfind.com-dot-icon-png-2698936.png" style="width: 12px; height: 12px;" class="greenicon">

<img src="<?php echo $datanew['imagepath']?>" alt="" class="profileimageset">
    <?php
   }
   
   ?>



    
    <h5 class="studentname">  Hi, <?php echo $datanew['firstname'].' '.$datanew['lastname'] ;?>   </h5>
    <button class="navbar-toggler" id="navtitle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse dropofmenu" id="navbarNavAltMarkup" >
      <div class="navbar-nav">
 
        <a class="nav-link" id="navtitle" href="student_logout.php">Log out</a>
        
    
      </div>
    </div>
  </div>
</nav>
</body>
</html>