<?php

include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
  echo "<script>window.location.href = 'index.php'</script>";
  die();
}
$batchID = $_GET['batchID'];
  $batchname = $_GET['batchname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrapJquery.php"); ?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Update Batch</title>
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
    .tablediv{
        float: right;
        width: 35vw;
        right: 500px;
        position: relative;
        margin-top: 17px;
    }
    .container{
      margin-top: 40px;
    }
    #newsvgimages{
   position: fixed;
   right: 20px;
   top: 80px;
   text-decoration: none;
   color: rgba(0, 30, 255 , 0.8004);
 
   }
   #newsvgimages:hover{
    text-decoration: underline;
   }
   #newsvgimages > img{
    position: relative;
    width: 20px;
   height: 20px;
   margin-right: 7px;
   }
    </style>
</head>
<body>
<?php include("adminheadermenu.php") ?>
<?php include("coordinaterNavigationMenu.php")?>
<div class="container">

<center><h1>Update Batch</h1></center>
<a href="batch.php" id="newsvgimages"> <img src="../images/back_l2mhb66hdam7.svg" alt=""> Back</a>
 <div class="message">

 </div>
 
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"><b>Batch name</b></label>
    <input type="hidden" value="<?php echo $batchID ; ?>" id="batchID">
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $batchname ; ?>">
     
  </div>
 
  <button type="submit" class="btn btn-primary" id="updatebutton" >Update</button>
 
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

<script type="text/javascript" src="UpdateBatch.js"></script>
</body>
</html>