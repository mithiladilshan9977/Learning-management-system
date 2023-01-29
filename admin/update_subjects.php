<?php
session_start();
include("dbconection.php");
  $subjectID = $_GET['subjectId'];

  
  $sql = "SELECT * FROM subject WHERE subjectId = '$subjectID'";
  $sqlquery = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($sqlquery);


  $code = $data['code'];
  $sujectID = $data['subjectId'];

  $title = $data['title'];
  $semester = $data['semester'];
  $description = $data['description'];

?>

<?php 
include("dbconection.php");

if(isset($_POST['updatesubjectinfo'])){
   
    $sujectID = $_POST['sujectID'];
    $updatedCOde = $_POST['subjectcode'];
    $subjectTitle = $_POST['subjectTitle'];
    $semester = $_POST['semester'];
    $description = $_POST['description'];

    $newsql = "UPDATE subject SET code='$updatedCOde' , title='$subjectTitle' , semester='$semester' , description='$description' WHERE subjectId='$sujectID'";
    $newquery = mysqli_query($conn, $newsql);

    if($newquery){
        echo '<div class="alert alert-success" role="alert">
         Successfully Updated
      </div>';

       echo "<script>window.location.href='subjects.php'</script>";
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
     
    .preloader{
        width: 100vw;
        height: 100vh;
        background-color: white;
        display: flex;
        position: absolute;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .preloader > img{
        width: 150px;
        height: 150px;
    }
    #preloader{
        width: 50px;
        height: 50px;
        margin-top: 15px;
    }
    #userpng{
        margin: 0px auto;
        margin-top: 15vh;
        position: relative;
        text-align: center;
        width: 100px;
        height: 100px;
    }
    .addbatchbtn{
        position: relative;
        top: 10px;
        left: 10px;
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
    <title>Document</title>
</head>
<body>
<?php include("adminheadermenu.php") ?>
<?php include("coordinaterNavigationMenu.php")?>

<!-- Button trigger modal -->
 

<!-- Modal -->
 



<div class="preloader">
          <img src="../images/camp.png" alt="" class="rounded float-start">

          <img src="../images/preloader.gif" alt="" id="preloader">
    </div>
 

<center><h1>Update Subect Details</h1></center>

<a href="subjects.php" id="newsvgimages"> <img src="../images/back_l2mhb66hdam7.svg" alt=""> Back</a>

<div class="container">
<form action="#" method="post"> 
<label for="">Subject Code</label>
   <input type="hidden" value="<?php echo $sujectID; ?>" id="" name="sujectID">
    <input class="form-control inputfilesss" type="text" placeholder="Subject Code" value ="<?php echo $code; ?>"  aria-label="default input example" id=" " name="subjectcode">
<br>
    <label for="">Subject Titles</label>
    <input class="form-control inputfilesss" type="text" placeholder="Subject Titles" value ="<?php echo $title; ?>" aria-label="default input example" id=" " name="subjectTitle">
<br>
<label for="">Select Semester</label>
    <select class="form-select" aria-label="Default select example" id=" " name="semester">
  <option selected ><?php echo $semester; ?></option>
  <option value="semester1">Semester 1</option>
  <option value="semester2">Semester 2</option>
  
</select>
<br>
<label for="">Description</label>
<br>


 
<textarea name="description"  cols="80" rows="10" id=" " >  <?php echo $description; ?></textarea>
     


<br>
 


<input type="submit" value="Update"  name = "updatesubjectinfo" id=" " class="btn btn-success" >


</form>
 


 
</div>

</div>
















<script type="text/javascript" src="Themainpreloader.js"></script>
<script type="text/javascript" src="updatesubject.js"></script>


</body>
</html>