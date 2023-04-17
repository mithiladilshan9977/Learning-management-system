<?php 
 
include("databaseconn.php");
session_start();
require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}

  $LecClassID = $_GET['id'];
  $subejctID = $_GET['subejectID'];
  $batchID = $_GET['batchID'];
 


  $_SESSION['subjectID_new'] = $subejctID;
  $_SESSION['batchID_new'] = $batchID;
  $_SESSION['teacherClassID'] = $LecClassID;



// $sql = "SELECT teacherbatchstudent.* , student.* , teacherclass.* FROM teacherbatchstudent   JOIN student ON teacherbatchstudent.teachstudeID = student.studentID   JOIN teacherclass ON teacherbatchstudent.teacherBatID=teacherclass.teacherClassID WHERE teacherclass.teacherClassID = '$LecClassID' AND student.oneandzero='0' AND student.status='Registered'";

// $query = mysqli_query($conn , $sql);



$sqlselectBatch = "SELECT student.*, batch.* FROM student LEFT JOIN batch ON student.batchID = batch.BatchID WHERE batch.BatchID = '$batchID'";
$sqlselectBatch_run = mysqli_query($conn, $sqlselectBatch);

$sqlforBackground = "SELECT student.*, batch.* FROM student LEFT JOIN batch ON student.batchID = batch.BatchID WHERE batch.BatchID = '$batchID' AND student.remoneAdd='0' AND student.status='Registered'";
$sqlforBackground_run = mysqli_query($conn, $sqlforBackground);


 


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrap.php")?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
 
    <title>My Students</title>
    <style>
        .container{
           
      
            margin-top: 70px;
         
        }
        #studentimage{
            width: 100px;
            height: 100px;
        }
        #innercontainer{
            display: flex;
            flex-direction: column;
            width: 100px;
            height: 100px;
            background-color: bisque;
            position: relative;
            transition: 0.2s all ease-in-out;

        }
        #imagestudent{
            width: 100px;
            height: 120px;
            display: inline-block;
            cursor: pointer;
            transition: 0.2s all ease-in-out;
            margin: 5px;

        }
        #newimagestudent{
             width: 100px;
            height: 120px;
        }
        #imagestudent:hover{
            transition: 0.2s all ease-in-out;
          box-shadow: 1px 1px 10px 8px rgba(0, 0, 0, 0.093);
          border: 1px solid rgba(0, 33, 151, 0.323);
        }
        .containernew{
          margin: 0 auto;
      text-align: center;
        }#theimage{
        width: 400px;
        height: 400px;
}
.nonptificationstitle{
    color: rgba(0, 0, 0, 0.433);
    
    margin: 5px;
}
.addsubjectnew{
            position: fixed;
            right: 30px;
            top: 65px;
            
            
        }

        .boxdiv{
          max-width:100%;
          min-height:62px;
          border-bottom:2px solid rgba(0, 0, 0, 0.167);
          position:relative;
        }
        .studentimage{
          width:60px;
          height:60px;
        }
        #selectaction{
          display:inline-block;
          width:120px;
          float :right;
          right:0px;
          top:10px;
          position:absolute;
        }
        .Unregistered{
          color:red;
       
      
       
        }
        .greenicon{
          position: relative;
          bottom: 10px;
      
        }
       
    </style>
</head>
<body>
<?php include("innerpreloader.php");?>
<?php include("lecturer_header.php")  ?>

<?php include("my_students_nav.php")  ?>



<button class="btn btn-outline-primary addsubjectnew" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">View Students</button>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">

    <h5 class="offcanvas-title" id="offcanvasScrollingLabel"> Batch All Students</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
 
  <?php 
  if(mysqli_num_rows($sqlselectBatch_run) ==0)
  {
    ?>
          <h2>No Students Yet !</h2>
    <?php
  }

  else  
  {
    while($newdatarows = mysqli_fetch_assoc($sqlselectBatch_run))
    {
      ?>
 <div class="boxdiv">

  <span  class="showthemessage" >

    </span>

    <?php 
    if($newdatarows['imagepath']=='../images/profile_0n4w2fa6t6a5.svg')
    {
      ?>
<img src="../images/profile_bf6x9xz97np5.svg" class="img-thumbnail studentimage" alt="...">
      <?php
    }else
    {
      ?>

<img src="<?php echo $newdatarows['imagepath']?>" class="img-thumbnail studentimage" alt="...">

<?php
      
    }
    
    ?>

<span class="onlinegreen"><?php echo $newdatarows['firstname'] . ' ' . $newdatarows['indexnumber']  ?> 

<?php 
if($newdatarows['greenicon'] =='1')
{
  ?>

<img src="../images/pngfind.com-dot-icon-png-2698936.png" style="width: 9px; height: 9px;" class="greenicon">
<?php
}

?>


 <span>

 <?php
 if($newdatarows['password'] == '') 
 {
  ?>
  <span class="Unregistered">Unregistered</span>
  <?php
 }
 else if($newdatarows['remoneAdd'] == '0')
 {
  ?>
<button value="<?php echo $newdatarows['studentID'] ?>" id="selectaction" class="btn btn-danger reply_btn">Remove</button>
  <?php

 }else  
 {

  ?>
<button value="<?php echo $newdatarows['studentID'] ?>" id="selectaction" class="btn btn-success reply_btn">Add</button>

<?php
 }
 
 ?>

</div>

<?php
    }
  }
  
  ?>

 




  </div>
</div>






<?php 

if(mysqli_num_rows($sqlforBackground_run) ==0)
{
  ?>       <div class="containernew">
                            <center>   <img src="../images/undraw_educator_re_ju47.svg" alt="" id="theimage" class="img-fluid"></center>
                            <br>

                            <p class="nonptificationstitle">No Students added yet 😥</p>


                               </div>
<?php
 
}
else

{
  ?>
<div class="container">
  <h6>Number of student <?php echo mysqli_num_rows($sqlforBackground_run)   ; ?></h6>
 
<div class="innercontainer">


<?php

}
?>

<?php
  while($studentdata = mysqli_fetch_assoc($sqlforBackground_run))
  
  {
    ?>


<div class="card" style="width: 18rem;" id="imagestudent">
  <img src="../images/student_c8u8j9e9ravk.svg" class="card-img-top" alt="..." id="newimagestudent">
 
    <span class="card-text"><?php echo $studentdata['firstname'];?> <?php echo $studentdata['lastname'];?></span>
    <div>
    <small><?php echo $studentdata['indexnumber'];?></small>
  </div>
   
 
</div>
 

  <?php
  }
  
  ?>


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
<script type="text/javascript" src="takeaction.js"></script>
</body>
</html>