<?php
session_start();
 if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }
  $depaermentID = $_GET['depaermentID'];
  $departmentName = $_GET['departmentName'];
  $dean = $_GET['dean'];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Update Department</title>
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
<?php include("adminNavigationMenu.php")?>



<div class="container">

<center><h1>Update Department</h1></center>
<a href="department.php" id="newsvgimages"> <img src="../images/back_l2mhb66hdam7.svg" alt=""> Back</a>

 <div class="message">

 </div>

  <div class="mb-3" style=" width: 650px;  margin: 0px auto;">
    <label for="exampleInputEmail1" class="form-label">Department name</label>
    <input type="hidden" value="<?php echo $depaermentID ; ?>" id="depaermentID">
    <input type="text" class="form-control" id="departmentName" aria-describedby="emailHelp" value="<?php echo $departmentName ; ?>">
    
    <br>
    <label for="exampleInputEmail1" class="form-label">Dean name</label>
    <input type="text" class="form-control" id="dean" aria-describedby="emailHelp" value="<?php echo $dean ; ?>">
      <br>
  <button type="submit" class="btn btn-primary mt-2" id="updatebutton" >Update</button>


  </div>
 
  
</div>




 </div>
<script type="text/javascript" src="Update_department.js"></script>
</body>
</html>