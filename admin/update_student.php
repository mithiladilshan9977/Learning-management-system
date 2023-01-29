<?php
include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
  echo "<script>window.location.href = 'index.php'</script>";
  die();
}

  $studentID = $_GET['studentID'];
  $stuFname = $_GET['stuFname'];
  $stuLname = $_GET['stuLname'];
  $NameOfBatch = $_GET['NameOfBatch'];
  $indexnumber = $_GET['indexnumber'];

$_SESSION['STUDENT_ID'] = $studentID;


?>

<?php 

include("dbconection.php");

$sql ="SELECT * FROM batch WHERE status = '0'";
$query = mysqli_query($conn, $sql);

 
 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrapJquery.php"); ?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Update Student</title>
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


<div class="container" >
<center><h1>Update Student</h1></center>
<a href="student.php" id="newsvgimages"> <img src="../images/back_l2mhb66hdam7.svg" alt=""> Back</a>
 <div class="message">

 </div>



 <div class="mb-3" >

 <div class="showmassage">
    
 </div>
    <label for="exampleInputEmail1" class="form-label">First name</label>
    <input type="hidden" value="<?php echo $studentID ; ?>" id="studentID">
    <input type="text" class="form-control" id="stuFname" aria-describedby="emailHelp" value="<?php echo $stuFname ; ?>">
    
    <br>
    <label for="exampleInputEmail1" class="form-label">Last name</label>
    <input type="text" class="form-control" id="stuLname" aria-describedby="emailHelp" value="<?php echo $stuLname ; ?>">
      <br>

      <label for="exampleInputEmail1" class="form-label">Index number</label>
    <input type="text" class="form-control" id="indexnumber" aria-describedby="emailHelp" value="<?php echo $indexnumber ; ?>">
      <br>

      <label for="exampleInputEmail1" class="form-label">Batch</label>
      <select class="form-select" aria-label="Default select example" id="selectstudentbatch">
      <?php 
     while($row = mysqli_fetch_assoc($query))
     
     {?>
            <option value="<?php echo $row['BatchID'] ; ?>"><?php echo $row['NameOfBatch'] ; ?></option>
<?php    
     }
?>
      </select>
      <br>
   
      <button type="submit" class="btn btn-primary" id="updatebuttonnew" >Update</button>
      <button type="submit" class="btn btn-danger" id="updatebuttonnew" data-bs-toggle="modal" data-bs-target="#apple">Update Password</button>


  </div>


  <!-- model -->
  <div class="modal fade" id="apple" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="messagediv"></div>
    <div class="modal-content">
      <div class="modal-header">
        
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <input class="form-control my-2" type="text" id="studentPassIndex" placeholder="Index Number Of <?php echo $stuFname.''.$stuLname;  ?>* " aria-label="default input example" required>
      <input class="form-control my-2" type="text" id="studentPassNew" placeholder="New Password *" aria-label="default input example" required>
      <input class="form-control my-2" type="text" id="studentRepeatPass" placeholder="Repeat New Password * " aria-label="default input example" required>



      </div>
      <div class="modal-footer">
        <button   class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button   class="btn btn-primary" id="savebtn">Save</button>
      </div>
    </div>
  </div>
</div>



</div>
<script type="text/javascript" src="update_student_password.js"></script>

<script type="text/javascript" src="update_student_info.js"></script>
</body>
</html>