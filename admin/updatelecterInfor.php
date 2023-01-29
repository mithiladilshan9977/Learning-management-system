<?php 

include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
  echo "<script>window.location.href = 'index.php'</script>";
  die();
}

  $lectureID = $_GET['lecID'];
  $Fname = $_GET['Fname'];
$Lanme = $_GET['Lname'];
$DepartmentID = $_GET['DepartName'];
  $usernameeee = $_GET['userN'];
    $registedORnot = $_GET['registedORnot'];



$sqelectdepSQL = "SELECT lecture.departmentID ,lecture.registeredONot  , deprtment.* FROM lecture LEFT JOIN deprtment ON lecture.departmentID = deprtment.depaermentID WHERE lecture.departmentID = '$DepartmentID' ";

$sqelectdepSQL_run = mysqli_query($conn, $sqelectdepSQL);

$getDepe = mysqli_fetch_assoc($sqelectdepSQL_run);
$deparmentName = $getDepe['departmentName'];
$depaermentIDselected = $getDepe['depaermentID'];

$selectAlldeparmt = "SELECT * FROM deprtment";
$selectAlldeparmt_run = mysqli_query($conn, $selectAlldeparmt);
 

if(isset($_POST['updateinfor'])){

      $lectureID = $_POST['lecid'];
      $username = $_POST['usernamenew'];
      $Fname = $_POST['fnamenew'];
      $Lname = $_POST['lnamenew'];
      $departmentid = $_POST['departmentID'];


    $updatelecSQLqqq = "UPDATE lecture SET username='$username' , firstname='$Fname' , lastname='$Lname' , departmentID='$departmentid' WHERE lectureID='$lectureID'"; 
    $updatelecSQL_run = mysqli_query($conn, $updatelecSQLqqq);

    if($updatelecSQL_run){
  
        echo '<script> 
  window.location.href="lectures.php" ;
        
         
        </script>';
          
    }else{
        echo "bad";
         
    }
       
  
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Lecture</title>
    <?php include("boostrapJquery.php"); ?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
</head>
<style>
  .bad{
    color: red;
  }
  .good{
    color: green;
  }
  .preloaderr{
    position: relative;
    margin-left: 10px;
    display: none;
  }
</style>
<body>
<?php  include("admin_preloader.php") ;?>
 
 <?php include("coordinaterheadermenu.php") ?>
 <?php include("coordinaterNavigationMenu.php")?>
<form action="#" method="post"  >
 <div class="container mt-3" style="width: 800px;">
<h1>Update Lecture</h1>
 
<input type="hidden" class="form-control mt-2 mb-3" value="<?php echo $lectureID; ?>" name="lecid">


<div class="container my-1" style="width: 600px;">
<label for="" class="mt-1">User Name</label>
<input type="text" class="form-control mt-2 mb-3" value="<?php echo $usernameeee; ?>" name="usernamenew">

<label for="" class="mt-1">First Name</label>
<input type="text" class="form-control mt-2 mb-3" value="<?php echo $Fname; ?>" name="fnamenew">

<label for="" class="mt-1">Last Name</label>
<input type="text" class="form-control mt-2 mb-3" value="<?php echo $Lanme; ?>" name="lnamenew">

<label for="" class="mt-1">Department Name</label>
<select class="form-select mt-2 mb-3" aria-label="Default select example" name="departmentID">
 
  <option selected value="<?php echo $depaermentIDselected; ?>" style="background-color: antiquewhite;"><?php echo $deparmentName; ?> (selected)</option>

  <?php 
  while($datenew = mysqli_fetch_assoc($selectAlldeparmt_run))
  {
    ?>
 <option value="<?php echo $datenew['depaermentID']?>"><?php echo $datenew['departmentName']?></option>
    <?php
  }
  
  ?>
 
   
</select>
 <?php  
 if($registedORnot =='Registered')
 {
    ?>
<input type="submit" value="update" class="btn btn-success mt-2" name="updateinfor">
 <a class="btn btn-danger  mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</a>
 
    <?php
 }else{
    echo '<div class="alert alert-danger" role="alert">
    Not Registered Yet
  </div>';
 }
 
 ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="showmessahenw"></div>
        <input type="hidden" value="<?php echo $lectureID; ?>" id="lecID">
        <label for="" class="my-2">New Password</label>  <img src="../images/preloader.gif" class="img-thumbnail preloaderr" style="width: 40px; height: 40px;">
        <input type="password" class="form-control mt-1"   id="newpassword">

        <label for="" class="my-2">New Password (again)</label> <small class="showthemessage"></small>
        <input type="password" class="form-control mt-1"  id="newpasswordAgain"> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="chagenewpass">Change</button>
      </div>
    </div>
  </div>
</div>


 

</form>
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

     <script src="changepassword.js"></script>
     <script src="insertNewPass.js"></script>
</body>
</html>