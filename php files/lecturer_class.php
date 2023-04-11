<?php
 include("databaseconn.php");
session_start();
  // require("lectetrSESSION.php");
 
if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}
 
$sql = "SELECT * FROM batch";
$query = mysqli_query($conn , $sql);
 

$newsql = "SELECT * FROM subject";
$newquery = mysqli_query($conn, $newsql);
// $data_subject = mysqli_fetch_assoc($newquery);
// $subjectID = $data_subject['subjectId'];
?>


<?php 
include("databaseconn.php");

 
error_reporting(0);
$loggedLectID = $_SESSION['lectureID'];
$newsql_new = "SELECT teacherclass.*,subject.*,batch.* , classimage.* FROM teacherclass LEFT JOIN subject ON teacherclass.subjectID = subject.subjectId LEFT JOIN batch ON teacherclass.batchID = batch.BatchID LEFT JOIN classimage ON teacherclass.thubnails=classimage.classimageid WHERE teacherID='$loggedLectID' AND classstatus='0'";

$newquery_new = mysqli_query($conn , $newsql_new);

$newsql_new_second = "SELECT teacherclass.*,subject.*,batch.* , classimage.* FROM teacherclass LEFT JOIN subject ON teacherclass.subjectID = subject.subjectId LEFT JOIN batch ON teacherclass.batchID = batch.BatchID LEFT JOIN classimage ON teacherclass.thubnails=classimage.classimageid WHERE teacherID='$loggedLectID' AND classstatus='0'";
$newsql_new_second_run = mysqli_query($conn , $newsql_new_second);





$deletedSQL = "SELECT teacherclass.*,batch.*,subject.* FROM teacherclass LEFT JOIN batch ON teacherclass.batchID = batch.BatchID LEFT JOIN subject ON subject.subjectId = teacherclass.subjectID WHERE teacherID='$loggedLectID' AND classstatus='1'";

$deletedsqlquery = mysqli_query($conn, $deletedSQL);



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrap.php")?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    
    <title>My Class</title>

    <style>
        .addsubject{
            position: fixed;
            right: 25px;
            top: 65px;
            z-index: 100;
            
            
        }
        .container{
          margin-top:80px ;
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
        #threedots{
          position: absolute;
          right: 1px;
          top: 1px;
          width: 30px;
          height: 30px;
        }
        #teacherbgimage{
          width: 500px;
          height: 500px;
          text-align: center;
          margin: 0px auto;
          opacity: 0.4;
        }
        .maintitell{
        
          text-align: center;
          margin: 0px auto;
          display: block;
          width: 80%;
        }
        .addsubjectnew{
            position: fixed;
            right: 150px;
            top: 65px;
            
            
        }
        .redcircel p {
            font-size: 15px;
            text-align: center;
            position: absolute;
            
            top: 3px;
        }
        .dropdownmenu{
        position: absolute;
        width: 500px;
        height: 600px;
        right: 10px;
        top: 110px;
        border-radius: 10px;
        box-shadow: 1px 1px 10px 1px rgba(0, 0, 0, 0.175);
        background-color: white;
        display:none;
       z-index:1;
    }
    #dropdownimage{
            opacity: 0.4; 
            width: 100%;
            height: 100%;
            position: absolute;
            text-align: center;
            margin: 0px auto;
        }
        .redcircel{
            border-radius: 50%;
            width: 30px;
            height: 30px;
         
        }
        #theseeetingicon{
          width: 32px;
          height: 32px;
          position: absolute;
          right:18px;
          top:115px;
          z-index: 50;
          cursor:pointer;
        }
        .showsetting{
          width: 150px;
          height: 180px;
      z-index: 10;
          position:absolute;
          right:25px;
          background-color: white;
          top:150px;
          display: none;
         
          box-shadow: 1px 1px 10px 2px rgba(0, 0, 0, 0.267);
          

        }
        .rotateSetting{
          transition: 0.2 all ease-in-out;
          padding: 3px;
          border-radius: 50%;
          background-color: rgba(0, 0, 0, 0.167);

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
        .thelinksetting{
          color: black;
          text-decoration: none;

        }
        .thelinksetting:hover{
          color: black;
        }
        .setprofile{
          cursor: pointer;
          margin-left: 12px;
        }
        .ulnew li{
 list-style: none;
        }
        .containernew{
          display: flex;
          flex-wrap: wrap;
          flex-direction: row;
          justify-content: space-evenly;
        }
        .imageapplenew{
          margin-right: 10px;
        }
        #clasimage{
   
          margin: 0px auto;
    
          margin-top: 10px;
          width: 350px;
          height: 350px;
          position: relative;
        }
          .boxesFilter{
            display: none;
          }
        @media (max-width:650)
        {
.dropdown{
  position: relative;
  right: 100px;
}
        }
       
    </style>
</head>
<body>
<?php include("innerpreloader.php");?>

    <?php include("lecturer_header.php")  ?>

    <?php include("lecturer_naviga_bar.php")  ?>

 
    <img src="../images/setting_t5vyfl9iph3m.svg" alt="" id="theseeetingicon" data-bs-toggle="tooltip" data-bs-title=" Settings" >
    <div class="showsetting">
    <ul class="ulnew" >
    <li class="mt-2"> <img src="../images/spanner_nya6vjztf30r.svg" class="img-thubmail mt-2"  style="width: 20px; height: 20px; position: absolute; left: 7px ; top:1px; " alt="..."> <a href="lecturer_settingpage.php"  class="thelinksetting"> <label for=" " class="setprofile">Preferences</label> </a>   </li>
    </ul>
      </div>



   <?php 
   
   if(mysqli_num_rows($deletedsqlquery) !== 0)
   {
    ?>
<a href="#" class="btn btn-danger addsubjectnew" id="chekbowdropdown" data-bs-toggle="tooltip" data-bs-title="Deleted classes appear here">
    
    Delected
      <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light   redcircel"><p><?php echo mysqli_num_rows($deletedsqlquery);?>  </p>
        <span class="visually-hidden">New alerts</span>
      </span>
    
    
    </a>


<?php
   }
   
   ?>   

    <div class="dropdownmenu">
      
    <table class="table table-striped">
      <tbody>
           <?php 
           if(mysqli_num_rows($deletedsqlquery) == 0)
           {
            echo '<img src="../images/undraw_appreciation_re_n3c1.svg " id="dropdownimage">';
            echo '<br>';
            echo '<center><h1>No Records Yet !</h1></center>';
            echo '<br>';
            echo '<center><h6>They will appear here </h6></center>';
           }else
           {
            ?>
<thead>
            <tr>
            <th scope="col">Btach</th>
            <th scope="col">Subject</th>
            <th scope="col"></th>
            </tr>
    </thead>
            <?php
           }
           
           ?>
           <?php while($rows = mysqli_fetch_assoc($deletedsqlquery))
           {
            ?>
<tr> 
                 
                 <td><?php echo $rows['NameOfBatch'] ; ?></td>
                 <td><?php echo $rows['title'] ; ?></td>
              
                 <td> <input class="form-check-input"  <?php if($rows["classstatus"]=='1'){echo "checked" ; }?>     onclick="classtoggleStatus(<?php echo $rows['teacherClassID'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                




          </tr>


<?php

           }
           ?>
    </tbody>
          </table>

      </div>


    <div class="container">
    <button type="button" class="btn btn-success   addsubject" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Batch
</button>



<div class="dropdown"  >
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
   Set Background
  </a>

  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#" id="setdefault">Default</a></li>
    <li><a class="dropdown-item" href="#" id="setrows">Rows</a></li>
 
  </ul>
</div>






<div class="containernew " style="position: relative;">
 
<?php 
if(mysqli_num_rows($newquery_new) <=0){
  echo " <p class='maintitell'>Add your first Class</p> ";
  echo "<br>";
  echo " <img src='../images/undraw_instant_support_re_s7un.svg' id='clasimage' > ";
}
while ($row_new_data  = mysqli_fetch_assoc($newquery_new))

{
  ?>


<div class="card newcard" style="width: 18rem;">
<a href="my_new_students.php?id=<?php echo $row_new_data['teacherClassID'];?> & subejectID=<?php echo $row_new_data['subjectId'];?> & batchID=<?php echo $row_new_data['BatchID'];?>">
  <img src="<?php echo $row_new_data['imagepath'];?>" class="card-img-top" alt="...">
  <div class="card-body" >
  <div class="dropdown">
  </a>
  <img src="../images/dot_hi2onqmkd5pj.svg" alt="" data-bs-toggle="dropdown" aria-expanded="false" id="threedots">
  
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#"   onclick="CardtoggleStatus(<?php echo $row_new_data['teacherClassID'];?>)">Delete</a></li>
   
  </ul>
 
</div>
 
  
    <h5 class="card-title"><?php echo $row_new_data['NameOfBatch'];?></h5>
    <p class="card-text"><?php echo $row_new_data['title'];?> </p>
 
  </div>

 
</div>
 
<?php


}


?>

 
</div>

 

 <div class="rowsFilertDiv boxesFilter">
<?php

if (mysqli_num_rows($newsql_new_second_run) <= 0) {
  echo " <h1 class='maintitell'>Add your first Class</h1> ";
  echo "<br>";
  echo "<center><img src='../images/undraw_instant_support_re_s7un.svg' id='teacherbgimage'> ";

}
while ($row_new_data  = mysqli_fetch_assoc($newsql_new_second_run))
{

  ?>


<div class="container my-2" style="width: 1000px; background-color: rgba(235, 235, 235, 0.563); padding: 7px; border: 2px solid rgba(235, 235, 235, 0.963);" >

  <img  src="../images/dot_hi2onqmkd5pj.svg" alt="" data-bs-toggle="dropdown" aria-expanded="false"  style="width: 25px; height: 25px;">
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#"   onclick="CardtoggleStatus(<?php echo $row_new_data['teacherClassID'];?>)">Delete</a></li>
   
  </ul>


  <a href="my_new_students.php?id=<?php echo $row_new_data['teacherClassID'];?> & subejectID=<?php echo $row_new_data['subjectId'];?> & batchID=<?php echo $row_new_data['BatchID'];?>"> 
 
 <img src="<?php echo $row_new_data['imagepath'];?>" alt="" class="img-thumbnail imageapplenew" style="width: 230px; height: 230px; cursor: pointer;"></a>
 
 <b> <h4 style="display:inline; margin: 6px;"> <?php echo $row_new_data['NameOfBatch'];?></h4> </b>
   <p style="display: inline;"><?php echo $row_new_data['title'];?></p>
</div>

<?php

}

?>


</div>



 
 






<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="message">

    </div>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add batch</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
 

        <label for="">Select Batch</label>
                            <select class="form-select" aria-label="Default select example" id="selectedbatch">
                        <?php 
                        while($rows = mysqli_fetch_assoc($query))
                         {
                            ?>

                   <option value="<?php echo $rows['BatchID'] ; ?>"  ><?php echo $rows['NameOfBatch'] ; ?></option>
                                 

                      <?php  }
                        
                        ?>
                        
                      
                        </select>

                        <br>
                        <label for="">Select Subject</label>

                        <select class="form-select" aria-label="Default select example" id="selectedsubject">
                        <?php 
                        while($newdata = mysqli_fetch_assoc($newquery))
                        {
                            ?>
<option value="<?php echo $newdata['subjectId'] ; ?>"><?php echo $newdata['title'] ; ?></option>
                      <?php  }
                        
                        ?>
                      
                        </select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="AddNewBatch">Ok</button>
      </div>
    </div>
  </div>
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
<script src="toggleclassStatus.js"></script>
<script type="text/javascript"  >
    $(document).ready(function () {
        $("#chekbowdropdown").on('click', function(){
    $(".dropdownmenu").slideToggle(500);
        });
    });
  </script>

<script>

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))



</script>

<script src="filternew.js"></script>
  <script type="text/javascript" src="showthesettingDicnew.js"></script>
<script type="text/javascript" src="CardtoggleStatus.js"></script>                
<script type="text/javascript" src="add_sebjectsForBatch.js"></script>
</body>
</html>