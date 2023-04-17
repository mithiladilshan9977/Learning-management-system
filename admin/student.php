<?php
session_start();
include("dbconection.php");
if(!isset($_SESSION['username'] )){
  echo "<script>window.location.href = 'index.php'</script>";
  die();
}
$sql ="SELECT * FROM batch WHERE status = '0'";
$query = mysqli_query($conn, $sql);



?>


<?php 

include("dbconection.php");

$sqlnew ="SELECT batch.* , student.* FROM batch INNER JOIN student ON batch.BatchID = student.batchID WHERE oneandzero='0'  ";
$querynew = mysqli_query($conn, $sqlnew);

 

 

$bdnumberofrows = mysqli_num_rows($querynew);
$rowsperpage = 10;
$numberofpages = ceil($bdnumberofrows/$rowsperpage);



if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}

$stattingpoint = ($page - 1 )*$rowsperpage;
$sqlnew ="SELECT batch.* , student.* FROM batch INNER JOIN student ON batch.BatchID = student.batchID WHERE oneandzero='0' LIMIT ".$stattingpoint.','.$rowsperpage;
$querynew = mysqli_query($conn, $sqlnew);





$dropdownsql = "SELECT batch.* , student.* FROM batch INNER JOIN student ON batch.BatchID = student.batchID WHERE oneandzero='1' ";
$dropdownquery = mysqli_query($conn , $dropdownsql);

if(isset($_POST['uploadExcel'])){

  $filename = $_FILES['excel']['name'];
  $fileExtention = explode('.', $filename);
  $fileExtention = strtolower(end($fileExtention));

  $newFileName = date("Y.m.d") . "-".date("h.i.sa") . "."  . $fileExtention;
  $targetDirectory = "excelfiles/" . $newFileName;
  move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

  error_reporting(0);
  ini_set('display_errors', 0);

  require("excelReader/excel_reader2.php");
  require("excelReader/SpreadsheetReader.php");

  $reader = new SpreadsheetReader($targetDirectory);
 foreach($reader as $key => $row){
   
    
    $firstName = $row[0];
    $lastName = $row[1];
    $studentBatchID = $row[2];
    $indexNumber = $row[3];

    $newsqlInsert = "INSERT INTO student (firstname , lastname, batchID, indexnumber) VALUES('$firstName','$lastName','$studentBatchID','$indexNumber')";

    $newsqlInsert_run = mysqli_query($conn , $newsqlInsert);



 }



}

$newfirstSQL = "SELECT * FROM batch";
$newfirstSQl_run = mysqli_query($conn, $newfirstSQL);
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
    .tablediv{
        float: right;
        width: 75vw;
        position: relative;
        margin-top: 17px;
    }
    .container{
        margin-top: 30px;
    }
    .addsubject{
            position: fixed;
            right: 25px;
            top: 65px;
            
            
        }
        #serachsubject{
        width: 30vw;
    }
    #imageupdate{
        width: 20px;
        height: 20px;
    }
    .title{
        position: relative;
        margin-left: 150px;
        margin-top: 20px;
        display: inline;
        z-index: -1;
    }
    .registered{
      color: rgba(0, 169, 14, 0.94);
    }
    .unregistered{
      color: rgba(169, 0, 0, 0.94);
    }
    .blackbtns{
        text-decoration: none;
    }
    .addsubjectnew{
            position: fixed;
            right: 150px;
            top: 65px;
            
            
        }
        .addsubjectdwadwad{
          position: fixed;
            right: 250px;
            top: 65px;
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
        z-index: 10;
        border-radius: 10px;
        box-shadow: 1px 1px 10px 1px rgba(0, 0, 0, 0.175);
        background-color: white;
    }
    .dropdownmenu{
        display: none;
    }
    #excelfile{
      display: none;
    }
    .svgimage{
        width: 400px;
        height: 400px;
    }
    .newtext{
        text-align: center;
        margin-top: 15px;
    }
    </style>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Students</title>
</head>
<body>
<?php  include("admin_preloader.php") ;?>
<?php include("adminheadermenu.php") ?>
<?php include("adminNavigationMenu.php")?>
<h1 class="title">Students</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success addsubject" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Student
</button>

<button class="btn btn-primary addsubjectdwadwad" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
  Batches
</button>





<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Check Batch IDs</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <table class="table">
        <thead>
             <tr>
              <th>Batch Name</th>
              <th>ID</th>
             </tr>
        </thead>
        <tbody>
          <?php 
             if(mysqli_num_rows($newfirstSQl_run) ==0)
             {
              ?>
                  <h2>No Records Found</h2> 

<?php
             }
             else 
             {
              while ($newrowdata = mysqli_fetch_assoc($newfirstSQl_run))
              {
                ?>
                         <tr>
                                 <td><?php echo $newrowdata['NameOfBatch']?></td>
                                 <td><?php echo $newrowdata['BatchID']?></td>

              </tr>

<?php
              }
             }
          
          ?>
        </tbody>
         
      </table>



    <div class="dropdown mt-3">
      
       
    </div>
  </div>
</div>








<a href="#" class="btn btn-danger addsubjectnew" id="chekbowdropdown" style="z-index: 10;">
    
Delected
  <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light   redcircel"><p><?php echo mysqli_num_rows($dropdownquery);?> </p>
    <span class="visually-hidden">New alerts</span>
  </span>


</a>

<div class="dropdownmenu">
 

  <table class="table table-striped  ">
  

    <tbody>
        
    <?php if(mysqli_num_rows($dropdownquery) == 0 ){
                echo '<img src="../images/undraw_appreciation_re_n3c1.svg " id="dropdownimage">';
        echo '<br>';
        echo '<center><h1>No Records Yet !</h1></center>';
        echo '<br>';
        echo '<center><h6>They will appear here </h6></center>';
            } else
            
            {?>
<thead>
            <tr>
            <th scope="col">Removed Student Name</th>
            <th scope="col"></th>
            </tr>
    </thead>






               <?php while($rows = mysqli_fetch_assoc($dropdownquery))
                
                {
                    ?>
                         <tr  > 
                 
                       <td><?php echo $rows['firstname'].' ' .$rows['lastname']  ; ?></td>
                    
                       <td>  <input class="form-check-input  " <?php if($rows["oneandzero"]=='1'){echo "checked" ; }?>     onclick="studenttoggleStatus(<?php echo $rows['studentID'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                      




                </tr>



<?php

                }
            }
            
            ?>
    </tbody>
    </table>

</div>









<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">

  <div class="showerrormessage">

  </div>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="z-index: 10;">Add Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <select class="form-select" aria-label="Default select example" id="selectstudentbatch">
  <option selected>Student Batch</option>
<?php 
     while($row = mysqli_fetch_assoc($query))
     
     {?>
            <option value="<?php echo $row['BatchID'] ; ?>"><?php echo $row['NameOfBatch'] ; ?></option>
<?php    
     }
?>
  
</select>
<br>
      <input class="form-control widthnew" type="text" placeholder="Index number" aria-label="default input example"   id="indexnumber" required>

      <br>

      <input class="form-control widthnew" type="text" placeholder="First name" aria-label="default input example"   id="studentFName" required>

      <br>

      <input class="form-control widthnew" type="text" placeholder="Last name" aria-label="default input example"   id="StudentLname" required>

      </div>
      <div class="modal-footer">

  
 <form action="#" method="post" enctype="multipart/form-data">
 <img src="../images/exceldemo.PNG" class="img-thumbnail" alt="...">
          <input type = "file"   id="excelfile" accept=".xlsx" name="excel" required>
         <label for="excelfile" class="btn btn-success"  >Import Excel</label>
         <input type="submit" value="Upload" class="btn btn-success" name="uploadExcel" required>

         



 </form>
 <hr>
 
     
      
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="okbutton">Ok</button>
       
      </div>
    </div>
  </div>
</div>



 

    <div class="container">

    <input class="form-control" type="text" placeholder="Search Student" aria-label="default input example" id="serachsubject">


    <table class="table table-striped showserachresult">


    
   <?php if(mysqli_num_rows($querynew) == 0 )
   {?>

<center>   <img src="../images/studentimage.svg" class="svgimage"></center>
 <p class="newtext">No students yet 😥</p>
 
<?php
                 
            } else{

              ?>
<thead>
            <tr>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Batch name</th>
            <th scope="col">Index number</th>
            <th scope="col">Status</th>
            <th scope="col">Delete</th>
            <th scope="col"> </th>

            </tr>
        </thead>
   <tbody>
              <?php
                while($rows = mysqli_fetch_assoc($querynew))
                
                {
                    ?>
                         <tr  > 
                       <td><?php echo $rows['firstname'] ; ?></td>
                       <td><?php echo $rows['lastname'] ; ?></td>
                       <td><?php echo $rows['NameOfBatch'] ; ?></td>
                       <td><?php echo $rows['indexnumber'] ; ?></td>
                       <td><?php 
                         if($rows['status'] == "Registered"){
                            echo "<p class='registered'>Registered</p>";
                         }else{
                            echo "<p class='unregistered'>Unregistered</p>";
                         }
                       
                       
                       
                      ?></td>
                       <td> <input class="form-check-input  " <?php if($rows["oneandzero"]=='1'){echo "checked" ; }?>     onclick="studenttoggleStatus(<?php echo $rows['studentID'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                       <td> <a href="update_student.php?studentID=<?php echo $rows['studentID'] ; ?> & stuFname=<?php echo $rows['firstname'] ; ?> & stuLname=<?php echo $rows['lastname'] ; ?> & NameOfBatch=<?php echo $rows['NameOfBatch'] ; ?> & indexnumber=<?php echo $rows['indexnumber'] ; ?> " class="btn btn-outline-success"  ><img src="../images/update_hwfy7ndx85t2.svg" alt="" id="imageupdate"></a></td>




                </tr>



<?php

                }
            }
            
            ?>
    
   </tbody>


    </table>
    <?php 
    for($btn=1;$btn<=$numberofpages;$btn++){
      echo '<button class="btn btn-dark mx-1 my-3"><a href="student.php?page='.$btn.'" class="text-light blackbtns"  >'.$btn.'</a></button>'; 
    }
    ?>


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

<script type="text/javascript" src="serchstudent.js"></script>
<script type="text/javascript" src="studenttoggleStatus.js"></script>
<script type="text/javascript" src="addNewStudet.js"></script>
<script type="text/javascript" src="Themainpreloader.js"></script>
<!-- <script type="text/javascript" src="excelfileImport.js"></script> -->

<script type="text/javascript"  >
    $(document).ready(function () {
        $("#chekbowdropdown").on('click', function(){
    $(".dropdownmenu").slideToggle(500);
        });
    });
  </script>

</body>
</html>