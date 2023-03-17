<?php 
include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }

     $AId = $_GET['AId'];
     $username = $_GET['username'];
     $firstname = $_GET['firstname'];
     $lastname = $_GET['lastname'];
     $email = $_GET['email'];


 
?>
<?php 
include("dbconection.php");

if(isset($_POST['updatesubjectinfo'])){
   
    $AId = $_POST['AId'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    $newsql = "UPDATE adminn SET username='$username' , firstname='$firstname' , lastname='$lastname' , email='$email' WHERE AId='$AId'";
    $newquery = mysqli_query($conn, $newsql);

    if($newquery){
        echo '<div class="alert alert-success" role="alert">
         Successfully Updated
      </div>';

       echo "<script>window.location.href='adminusers.php'</script>";
    }
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrapJquery.php"); ?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Update admin</title>

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
    .updatediv{
         width: 55vw;
         float: right;
         position: relative;
         right: 120px;
         
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
<center><h1>Update Admin Users</h1></center>
<a href="adminusers.php" id="newsvgimages"> <img src="../images/back_l2mhb66hdam7.svg" alt=""> Back</a>
<form action="#" method="post" style="width: 650px; margin: 0px auto;">
<input type="hidden" value="<?php echo $AId; ?>" name="AId">
<label for=""><b>User name</b></label>
   <input type="hidden" value="<?php echo 'a'; ?>" id="" name="sujectID">
    <input class="form-control inputfilesss" type="text" placeholder="Subject Code" value ="<?php echo $username; ?>"  aria-label="default input example" id=" " name="username">
<br>
<label for=""><b>First name</b></label>
<input class="form-control inputfilesss" type="text" placeholder="Subject Code" value ="<?php echo $firstname; ?>"  aria-label="default input example" id=" " name="firstname">
<br>
<label for=""><b>Last name</b></label>
<input class="form-control inputfilesss" type="text" placeholder="Subject Code" value ="<?php echo $lastname; ?>"  aria-label="default input example" id=" " name="lastname">
<br>
<label for=""><b>Email address</b></label>
<input class="form-control inputfilesss" type="text" placeholder="Email address" value ="<?php echo $email; ?>"  aria-label="default input example" id=" " name="email">
<br>
<input type="submit" value="Update"  name = "updatesubjectinfo" id=" " class="btn btn-success" >

<a href="./qrcode.php" style="text-decoration: none;" class="btn btn-info" >Generate QR</a>

</form>
   
 


<div>

</body>
</html>