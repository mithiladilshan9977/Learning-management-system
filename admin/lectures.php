<?php 
include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
  echo "<script>window.location.href = 'index.php'</script>";
  die();
}
$sql = "SELECT * FROM deprtment";
$query = mysqli_query($conn , $sql);

 
  $thedepermentID = $_SESSION['DEPERTMENTID'];
 

?>


<?php 
include("dbconection.php");

$newsql = "SELECT lecture.* , deprtment.* FROM lecture INNER JOIN deprtment ON lecture.departmentID = deprtment.depaermentID WHERE lectstatus='0' AND departmentID='$thedepermentID'";
$newmysqli = mysqli_query($conn , $newsql);


$BDnumberofrows=mysqli_num_rows($newmysqli);
$rowsperpage = 10;
$numberofpages = ceil($BDnumberofrows/$rowsperpage);


 if(isset($_GET['page'])){
    $page = $_GET['page'];
 }else{
    $page =1;
 }
 $statringpoint =($page - 1)*$rowsperpage;
 $newsql = "SELECT lecture.* , deprtment.* FROM lecture INNER JOIN deprtment ON lecture.departmentID = deprtment.depaermentID WHERE lectstatus='0'  AND departmentID='$thedepermentID' LIMIT ".$statringpoint.',' .$rowsperpage;
 $newmysqli = mysqli_query($conn , $newsql);


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
 z-index: -1;
        display: inline;
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
    .svgimage{
      width: 400px;
      height: 400px;
        }
        .noaddedsubjectyet{
            text-align: center;
        }
    
    </style>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Lectures</title>
</head>
<body>
<?php  include("admin_preloader.php") ;?>
 
 

<?php include("coordinaterheadermenu.php") ?>
<?php include("coordinaterNavigationMenu.php")?>


<!-- Button trigger modal -->
<button type="button" class="btn btn-success addsubject" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add lecture
</button>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    
    <div class="modal-content">
    <div class="showmasssage">
      
      </div>
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add lecture</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">




 
</select>
<br>
      <input class="form-control widthnew" type="text" placeholder="First name" aria-label="default input example"   id="LectFirstName">

      <br>

      <input class="form-control widthnew" type="text" placeholder="Last name" aria-label="default input example"   id="LectLastName">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="okbtnnow">Ok</button>
      </div>
    </div>
  </div>
</div>



<h1 class="title">Lectures</h1>

<div class="container">

<input class="form-control" type="text" placeholder="Search Lecture" aria-label="default input example" id="serachsubject">

<table class="table table-striped showserachresult">


   <?php if(mysqli_num_rows($newmysqli) == 0 )
   { ?>

<center><img src="../images/nosir.svg" class="svgimage"></center>
<p class="noaddedsubjectyet">No lecturers added yet 😥</p>
   <?php
            } else{
              ?>
<thead>
            <tr>
            <th scope="col">Username</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Department name</th>
            <th scope="col">Status</th>
            <th scope="col">Present</th>
            <th scope="col"> </th>
            <th scope="col"> </th>

            </tr>
        </thead>

        <tbody>

              <?php
                while($rows = mysqli_fetch_assoc($newmysqli))
                
                {
                    ?>
                         <tr  > 
                       <td><?php echo $rows['username'] ; ?></td>
                       <td><?php echo $rows['firstname'] ; ?></td>
                       <td><?php echo $rows['lastname'] ; ?></td>
                       <td><?php echo $rows['departmentName'] ; ?></td>
                       <td><?php 
                        if($rows['registeredONot'] =="Registered"){
                          echo "<p class='registered'>Registered</p>";
                        }else{
                          echo "<p class='unregistered'>Unregistered</p>";
                        }
                       ?></td>
                       <td><?php echo $rows['presentONot'] ; ?></td>
                       <td> <input class="form-check-input  " <?php if($rows["lectstatus"]=='1'){echo "checked" ; }?>     onclick="lecturetoggleStatus(<?php echo $rows['lectureID'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                       <td> <a href="updatelecterInfor.php?lecID=<?php echo $rows['lectureID'] ?> & userN=<?php echo $rows['username'] ?> & Fname=<?php echo $rows['firstname'] ?> & Lname=<?php echo $rows['lastname'] ?> & DepartName=<?php echo $rows['departmentID'] ?> & registedORnot=<?php echo $rows['registeredONot']  ?>" class="btn btn-outline-success"  ><img src="../images/update_hwfy7ndx85t2.svg" alt="" id="imageupdate"></a></td>




                </tr>



<?php

                }
            }
            
            ?>
    
   </tbody>
  </table>
  <?php 
   
   for($btn=1;$btn<=$numberofpages;$btn++){
    echo '<button class="btn btn-dark mx-1 my-3 btnclass"><a href="lectures.php?page='.$btn.'" class="text-light blackbtns"  >'.$btn.'</a></button>';
}
   
   
   ?>


  </div>
 
 

<div class="preloader">
          <img src="../images/camp.png" alt="" class="rounded float-start">

          <img src="../images/preloader.gif" alt="" id="preloader">
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



<script type="text/javascript" src="lecturetoggleStatus.js"></script>
<script type="text/javascript" src="add_new_lecture.js"></script> 

<script type="text/javascript" src="serchlecturer.js"></script>
<script type="text/javascript" src="Themainpreloader.js"></script>


</body>
</html>