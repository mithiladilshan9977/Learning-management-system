<?php 
 include("databaseconn.php");

 

if(isset($_SESSION['lectureID'])){
  $lectertID = $_SESSION['lectureID'];
}else{
  echo "noooooo session";
}


$sql = "SELECT * FROM lecture WHERE lectureID='$lectertID'";
$queryyyyy = mysqli_query($conn, $sql);

$datanew = mysqli_fetch_assoc($queryyyyy);
 
 


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
    .nameoflectetr{
      position: absolute;
      float: right;
      right: 85px;
      color: white;
    }
    </style>
</head>
<body>
    
<nav class="navbar" style="background-color: rgba(0, 30, 255, 0.867)">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" id="navtitle">Go - Xm Lecturer panel</a>
    <h5 class="nameoflectetr">Hi, <?php echo $datanew['firstname'].' '.$datanew['lastname']?></h5>
    <button class="navbar-toggler" id="navtitle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse dropofmenu" id="navbarNavAltMarkup" >
      <div class="navbar-nav">
 
        <a class="nav-link" id="navtitle" href="lecturer_logout.php">Log out</a>
    
      </div>
    </div>
  </div>
</nav>
</body>
</html>