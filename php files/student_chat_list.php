<?php 
 include("databaseconn.php");
 session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
  header("location:../index.php");
}
else{
  $studentid = $_SESSION['studentID'];
  $studeBatch =  $_SESSION['STUDENTBATCH'];
}

$selectStudentSQL = "SELECT * FROM student WHERE studentID !='{$studentid}' AND batchID ='{$studeBatch}' ";
$selectStudentSQL_run = mysqli_query($conn, $selectStudentSQL);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Student Chat</title>
</head>
<style>
     
    .memberHolder{
 
      width: 100%;
      padding: 10px;
      float: right;
     height: 80px;
     margin: 5px ;
      background-color: #007bff;
      transition: all 0.2 ease-in-out;
    }
    .memberHolder:hover{
       box-shadow: 1px 1px 20px 1px   black;
       transition: all 0.2 ease-in-out;
    }
    .imhaeHolder{
      display: inline-block;
      width: 80px;
      height: 80px;
      float: left;
    }
    .imhaeHolder img{
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }
    .memberHolder h5{
      color: white;
     
    }
    .memberHolder p{
      color: white;
     
    }
   
    .onlineicon{
      width: 10px;
      height: 10px;
      margin-left: 10px;

    }
    .stillnorfrietdsTExt{
      margin: 0 auto;
      margin-bottom: 20px;
      text-align: center;
    }
    .noFirendsImage{
      width: 500px;
      height: 400px;
    }
</style>
<body>
 

<?php include("student_header.php")  ?>

<?php include("student_naviga_bar.php")  ?>




<div class="container" style="max-width: 800px; margin-top: 90px;">

 <?php 
 
 if(mysqli_num_rows($selectStudentSQL_run) == 0)
 {
  ?>
 <p class="stillnorfrietdsTExt">😥 Still you don't have any friends 😥<br>Once there are registered, they will appear here 😍 </p>
 <center><img src="../images/fireends.png" class="noFirendsImage"></center>
  <?php
 }else  

 {
  while($newdata = mysqli_fetch_assoc($selectStudentSQL_run))
  {
    ?>
<div class="memberHolder"> <a href="student_chat.php?studentID=<?php echo  $newdata['studentID'] ?> & firstName=<?php echo  $newdata['firstname'] ?> & lastName=<?php  echo $newdata['lastname'] ?> & imagepath=<?php  echo $newdata['imagepath'] ?>" style="text-decoration: none;">
    <div class="imhaeHolder">
      <img src="<?php echo $newdata['imagepath']?>" alt="">
    </div>
    <h5><?php echo $newdata['firstname'].' ' . $newdata['lastname']?> </h5>
    <p>Tap over here to chat with <?php echo $newdata['firstname'].' ' . $newdata['lastname']?></p>
    
     
    </a>
  </div>
    <?php
  }
 }
 
 ?>
 
  
  
</div>


<script src="checkingOnlineStatus.js"></script>
</body>
</html>