<?php 
 include("databaseconn.php");
 session_start();
require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
  header("location:../index.php");
}
 
$studentID = $_SESSION['studentID'];
$sql = "SELECT * FROM teacherbatchstudent LEFT JOIN teacherclass ON teacherclass.teacherClassID = teacherbatchstudent.teacherBatID LEFT JOIN batch ON batch.BatchID = teacherclass.batchID LEFT JOIN subject ON subject.subjectId = teacherclass.subjectID LEFT JOIN lecture ON lecture.lectureID = teacherclass.teacherID WHERE teacherbatchstudent.teachstudeID = '$studentID'";

$query = mysqli_query($conn , $sql);



$newsql = "SELECT * FROM student WHERE studentID='$studentID'";
$newquery = mysqli_query($conn, $newsql);

$selectnoteSQl = "SELECT * FROM studentsnotes WHERE studentid='$studentID' AND shownote='0'";
$selectnoteSQl_run = mysqli_query($conn, $selectnoteSQl);

if(isset($_POST['submitbtn']))
{
   $hiddennotidvale = $_POST['hiddennotidvale'];
   $updattedtext = $_POST['updattedtext'];

  $newselectupdatesql = "UPDATE studentsnotes SET note='$updattedtext' WHERE noteid='$hiddennotidvale' ";
  $newselectupdatesql_run = mysqli_query($conn, $newselectupdatesql);

  echo "<script>window.location.href='student_class.php'</script>";
  
}
  


if(isset($_POST['setprofile'])){
 

  $filename = $_FILES['profileimage']['name'];
  $fileTemName = $_FILES['profileimage']['tmp_name'];
  $filesize = $_FILES['profileimage']['size'];
  $fileEroor = $_FILES['profileimage']['error'];
  $fileTyepe = $_FILES['profileimage']['type'];

  $fileExtention  = explode('.' , $filename);
  $fileActualExtention = strtolower($fileExtention['1']);

  $allowed = array('pdf' , 'jpg', 'png');

  if(in_array($fileActualExtention , $allowed)){
    if($fileEroor ===0){
      if($filesize <1000000){
      
       $fileDest = 'profileimage/' .date("Y.m.d") . "-".date("h.i.sa") .'.'.$fileActualExtention;
       move_uploaded_file($fileTemName , $fileDest);

       $newsql1 = "UPDATE student SET imagepath='$fileDest' WHERE studentID='$studentID'";

       $newquery1=mysqli_query($conn,$newsql1);
            if($newquery1){
                echo "<script>window.location.href='student_class.php?'</script>";
            }
      }else{
        echo '<div class="alert alert-danger" role="alert">
        File is too large
   </div>';

      
      }
    }else{
      echo '<div class="alert alert-danger" role="alert">
      There is an error
   </div>';
   
       
    }
}else{ 
echo "File extention failed";
}


}

 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Student Class</title>
    <?php include("boostrap.php"); ?>

    <style>
        .containernew{
          display: flex;
          flex-wrap: wrap;
          flex-direction: row;
          justify-content: space-evenly;
        }
        #threedots{
          position: absolute;
          right: 10px;
          bottom: 1px;
          width: 30px;
          height: 30px;
        }
       
      
         .newcard{
            margin: 10px;
          cursor: pointer;
          transition: 0.2s all ease-in-out;
         }
         .newcard:hover{
          transition: 0.2s all ease-in-out;
          box-shadow: 1px 1px 10px 8px rgba(0, 0, 0, 0.093);
          border: 1px solid rgba(0, 33, 151, 0.323);
        }
        .imageimage{
          opacity: 0.4;
        }
        .titlmain{
          text-align: center;
          margin: 0 auto;
   
        }
        .main{
          width: 100%;
          padding: 10px;
        }
        #theseeetingicon{
          width: 32px;
          height: 32px;
          position: absolute;
          right:18px;
          top:60px;
          cursor:pointer;
        }
       
        .showsetting{
          width: 150px;
          height: 180px;
      z-index: 10;
          position:absolute;
          right:25px;
          background-color: white;
          top:100px;
          display: none;
          box-shadow: 1px 1px 10px 2px rgba(0, 0, 0, 0.267);
          

        }
        .dropdownmenu{
          color:black;
       
       
         
        }
        .dropdownmenu li{
          list-style: none;
          cursor: pointer;
          margin: 10px 0px;
          display: inline-block;
  
        }
         
        #choosetheprofile{
          display: none;
          
        }
        .setprofile{
          cursor: pointer;
        }
        .maindivwadwad{
          width: 250px;
        height: 500px;
          background-color: white;
          border: 1px solid rgba(0, 0, 0, 0.267);
          border-radius: 10px;
          float: right;
          padding: 8px;
          margin-top: 80px;
         overflow-y: scroll;
          position: relative;
        }
        .pdfiles{
   margin: 5px 0px 5px 10px;
        float: left;
        }
        .container{
            margin-top: 70px;
            float: left;
            position: absolute;
        }
        .addbtn{
        position: relative;
        margin: 8px 0px 0px 40px;
         
        }
        .noteimage{
          width: 20px;
          height: 20px;
        
        }
        .noteimagenot{
          opacity: 0.4;
        }
        .crossimage{
          width: 26px;
          height: 26px;
          margin-left: 10px;
          cursor: pointer;
        }
        .updateimage{
          width: 25px;
          height: 25px;
      
          margin-left: 3px;
          cursor: pointer;
        }
        #removeNote{
      
          border: none;
          display: inline;
        }
        .updatemaindiv{
          display: none;
        }
        #updatebtn{
   
          border: none;
          display: inline;
          
           
        }
        .rotateSetting{
          transition: 0.2 all ease-in-out;
          padding: 3px;
          border-radius: 50%;
          background-color: rgba(0, 0, 0, 0.167);

        }
        .thelinksetting{
          color: black;
          text-decoration: none;

        }
        .thelinksetting:hover{
          color: black;
        }
        
        @media (max-width:643px){
          .maindivwadwad{
            background-color: white;
            display: block;
            width: 100%;
             overflow: scroll;
          }
          .noteimagenot{
         width: 180px;
       height: 180px;
 
        }
           .container{
            position: relative;
            display: block;
            width: 100%;
            margin-top: 10px;
            transition: all 0.8 ease-in-out;
           }
        }
        </style>
</head>
<body>
<?php include("innerpreloader.php");?>

<?php include("student_header.php")  ?>

<?php include("student_naviga_bar.php")  ?>
<div class="noteaddedmessag"></div>
<img src="../images/setting_t5vyfl9iph3m.svg" alt="" id="theseeetingicon"  >
<div class="showsetting">
<ul class="dropdownmenu">
  <form action=" " method="POST" enctype="multipart/form-data">
  <li> <img src="../images/profile_ex13t41bjw3j.svg" class="img-thubmail"  style="width: 20px; height: 20px; position: absolute; left: 7px ; top:13px; " alt="..."> <input type="file" id="choosetheprofile" name="profileimage"> <label for="choosetheprofile" class="setprofile">Set Profile</label>  <button class="badge btn btn-success" name="setprofile">set</button>  </li>

  
  </form>
  



  <li> <img src="../images/spanner_nya6vjztf30r.svg" class="img-thubmail"  style="width: 20px; height: 20px; position: absolute; left: 7px ; top:3.7rem; " alt="..."> <a href="settingpage.php"  class="thelinksetting"> <label for=" " class="setprofile">Preferences</label> </a>   </li>


</ul>
    </div>
    <div class="maindivwadwad">
      <h5 class="pdfiles">Write a note</h5>
      <button class="badge btn btn-success addbtn" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button>
      <hr>
 <?php 
 if(mysqli_num_rows($selectnoteSQl_run) ==0)
 {
  ?>
  <center>
  <h4 class="mt-3">No Notes</h4>
  </center>
<center> <img src="../images/note_84wypy2azh9b.svg" class="img-thumbnail noteimagenot" alt="..."></center>

  <?php
 }
 else {
   
  while($data = mysqli_fetch_assoc($selectnoteSQl_run)) {
   
    ?>


  <div class="noteremovemassage"> </div>
<div class="notediv">
  <small class="setnotepara"><img src="../images/note_ypuv4i58oezp.svg" class="img-thumbnail noteimage" alt="..."> <?php echo $data['note'] ?></small> 
  
  <button value="<?php echo $data['noteid'];?>"  data-bs-toggle="modal" data-bs-target="#exampleModalapple" id="updatebtn"><img src="../images/update_m7kmtn0d7xq1.svg" class="img-thumbnail  updateimage" alt="..." ></button>
  
  <button value="<?php echo $data['noteid'];?>" id="removeNote"><img src="../images/cross_3vf5rmca0993.svg" class="crossimage" alt="..."></button> 

  

  <div class="updatemaindiv"> 
    <form action="" method="post">
    <textarea name="updattedtext" id="" cols="30" rows="10" class="form-control mt-2"> <?php echo $data['note'] ?></textarea>
    <input type="hidden" value="<?php echo $data['noteid'];?>" name="hiddennotidvale">
    <input type="submit" value="submit" name="submitbtn"  class="btn btn-success mt-2">
    </form>
 
 
</div>

 
</div>
 
<?php
  }
 }
 
 ?>
 
</div>
 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <textarea name="" id="thetextarea" cols="30" rows="10" class="form-control" placeholder="Write your note here"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="okbtn">Ok</button>
      </div>
    </div>
  </div>
</div>




<div class="container">

<div class="containernew">
<?php 

if(mysqli_num_rows($query)==0)
{
  ?>
  <div class="main">
  <h3 class="titlmain">No added Classes</h3>

  </div>
    <img src="../images/clasroom.svg" class="img-fluid imageimage" alt="...">

    

<?php
}
while($rows = mysqli_fetch_assoc($query))
{
    
    ?>



<div class="card newcard" style="width: 17rem; height: 16rem;">

<a href="seedownloadelFiles.php?subjectID=<?php echo $rows['subjectId'] ; ?>">
  <img src="../images/imagdwades.png" class="card-img-top" alt="...">
  <div class="card-body">
  </a>
    <h5 class="card-title"><?php echo $rows['title']?></h5>
    

    <img src="../images/dot_hi2onqmkd5pj.svg" alt=""data-bs-toggle="dropdown" aria-expanded="false" id="threedots">
  <div class="container">
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#"  > Add Favorite</a></li>
   
  </ul>
  </div>
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
<script type="text/javascript" src="showthesettingDicnew.js"></script>
<script type="text/javascript" src="addnotes.js"></script>
<script type="text/javascript" src="removeNote.js"></script>
<script type="text/javascript" src="updatebtn.js"></script>
<script type="text/javascript" src="insertUpdatenew.js"></script>
 
</body>
</html>