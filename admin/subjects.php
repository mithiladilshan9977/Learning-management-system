<?php 
session_start();
include("dbconection.php");
if(isset($_SESSION['DEPERTMENTID'] )){
    $departmentID=  $_SESSION['DEPERTMENTID'];
 }


$sqlquery = "SELECT * FROM subject WHERE status='0' AND depaermentID='$departmentID' ";
$mysqliquery = mysqli_query($conn , $sqlquery);
$num = mysqli_num_rows($mysqliquery);
$numberofpages = 10;
$totaelpaegs = ceil($num/$numberofpages);

if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }


if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$statrtlimite = ($page - 1)*$numberofpages;
$sqlquery ="SELECT * FROM subject WHERE status='0' AND depaermentID='$departmentID' LIMIT ".$statrtlimite .','.$numberofpages;
$mysqliquery = mysqli_query($conn,$sqlquery);



$dropdownsql = "SELECT * FROM subject WHERE status='1'";
$dropdownquery = mysqli_query($conn , $dropdownsql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrapJquery.php"); ?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Subjects</title>
    <style>
        .addsubject{
            position: fixed;
            right: 25px;
            top: 65px;
            
            
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
    .deletebtn{
        position: relative;
        float: right;
        right: 10px;
        top:10px;
       
    }
    .container{
        margin-top: 30px;
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
    .blackbtns{
        text-decoration: none;
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
    }
    .dropdownmenu{
        display: none;
    }
    #chekbowdropdown{
         

    }
    .dropdowndiv{
        position: relative;
        width: 80%;
        margin: 0px auto;
        height: 50px;
        background-color: antiquewhite;
        display: flex;

    }
    .dropdowndiv a {
        display: block;
        float: right;
    }
    .addsubjectnew{
            position: fixed;
            right: 150px;
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
    </style>
</head>
<body>
<?php include("coordinaterheadermenu.php") ?>
<?php include("coordinaterNavigationMenu.php")?>
<?php  include("admin_preloader.php") ;?>
   <a href="addsubject.php" class="btn btn-success addsubject" style="z-index: 10;" >Add subject</a>

   
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
            <th scope="col">Removed Suject Name</th>
            <th scope="col"></th>
            </tr>
    </thead>






               <?php while($rows = mysqli_fetch_assoc($dropdownquery))
                
                {
                    ?>
                         <tr> 
                 
                       <td><?php echo $rows['title'] ; ?></td>
                    
                       <td> <input class="form-check-input  " <?php if($rows["status"]=='1'){echo "checked" ; }?>     onclick="toggleStatus(<?php echo $rows['subjectId'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                      




                </tr>



<?php

                }
            }
            
            ?>
    </tbody>
    </table>

</div>

 
   




 
  

   <h1 class="title">Subjects</h1>


 
 <div class="container">
 
 <input class="form-control" type="text" placeholder="Search By Subject Name" aria-label="default input example" id="serachsubject">
 


 


 <table class="table table-striped showserachresult">
        <thead>
            <tr>
            <th scope="col">Code</th>
            <th scope="col">Suject Title</th>
            <th scope="col">Semester</th>
            <th scope="col">Description</th>
            <th scope="col">Delete</th>

            </tr>
        </thead>
    <tbody>
        

    <?php if(mysqli_num_rows($mysqliquery) == 0 ){
                echo '<tr><div class="alert alert-danger" role="alert">
                No Records Found
              </div></tr>'; 
            } else{
                while($rows = mysqli_fetch_assoc($mysqliquery))
                
                {
                    ?>
                         <tr  > 
                       <td><?php echo $rows['code'] ; ?></td>
                       <td><?php echo $rows['title'] ; ?></td>
                       <td><?php echo $rows['semester'] ; ?></td>
                       <td><?php echo $rows['description'] ; ?></td>
                       <td> <input class="form-check-input  " <?php if($rows["status"]=='1'){echo "checked" ; }?>     onclick="toggleStatus(<?php echo $rows['subjectId'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                       <td> <a href="update_subjects.php?subjectId=<?php echo $rows['subjectId'] ; ?> & code=<?php echo $rows['code'] ;?> & title=<?php echo $rows['title'] ;?> & semester=<?php echo $rows['semester']?> & description=<?php echo $rows['description']?> " class="btn btn-outline-success"  ><img src="../images/update_hwfy7ndx85t2.svg" alt="" id="imageupdate"></a></td>




                </tr>



<?php

                }
            }
            
            ?>






     
    </tbody>
         

      </table>
      <?php 
 for($btn=1;$btn<=$totaelpaegs;$btn++){
    echo '<button class="btn btn-dark mx-1 my-3"><a href="subjects.php?page='.$btn.'" class="text-light blackbtns"  >'.$btn.'</a></button>';
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


 <script src="toggleStatus.js"></script>
    <script type="text/javascript" src="Themainpreloader.js"></script>
  <script type="text/javascript" src="serchsubject.js"></script>
  <script type="text/javascript" src="deletsubject.js"></script>
  <script type="text/javascript"  >
    $(document).ready(function () {
        $("#chekbowdropdown").on('click', function(){
    $(".dropdownmenu").slideToggle(500);
        });
    });
  </script>
</body>
</html>