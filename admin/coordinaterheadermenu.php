<?php 

include("dbconection.php");
 
if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }else{
  $conrdinatername = $_SESSION['username'];
 }

$selectnewsql = "SELECT * FROM adminn WHERE username='$conrdinatername'";
$selectnewsql_run = mysqli_query($conn, $selectnewsql);
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrapJquery.php"); ?>
    <title>Document</title>
    <style>
         #navtitle{
        color: white;
    }
    .mainheading{
      display:inline ;
      position:absolute;
      float:right;
      right:100px;
      color:white;
    }
    </style>
</head>
<body>
    
<nav class="navbar" style="background-color: rgba(0, 30, 255, 0.867)">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" id="navtitle">Go - Xm Coordinator panel</a>
    <h6 class="mainheading">Logged-in as <small>'<?php $datanew = mysqli_fetch_assoc($selectnewsql_run);
     echo $name = $datanew['username'];
  
  
    ?>'</small></h6>
    <button class="navbar-toggler" id="navtitle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse dropofmenu" id="navbarNavAltMarkup" >
      <div class="navbar-nav">
 
        <a class="nav-link" id="navtitle" href="admin_logout.php">Log out</a>
    
      </div>
    </div>
  </div>
</nav>
</body>
</html>