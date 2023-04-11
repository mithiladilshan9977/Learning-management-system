<?php 
include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }
$sqlquery = "SELECT * FROM  deprtment WHERE status='0'";
$mysqliquery = mysqli_query($conn , $sqlquery);



$BDnumberofrows=mysqli_num_rows($mysqliquery);
$rowsperpage = 10;
$numberofpages = ceil($BDnumberofrows/$rowsperpage);


 if(isset($_GET['page'])){
    $page = $_GET['page'];
 }else{
    $page =1;
 }
 $statringpoint =($page - 1)*$rowsperpage;
 $sqlquery = "SELECT * FROM deprtment WHERE status='0' LIMIT ".$statringpoint.',' .$rowsperpage;
 $mysqliquery = mysqli_query($conn , $sqlquery);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Departments</title>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
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
    .blackbtns{
        text-decoration: none;
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
</head>
<body>
<?php  include("admin_preloader.php") ;?>
<?php include("adminheadermenu.php") ?>
<?php include("adminNavigationMenu.php")?>
<h1 class="title">Departments</h1>

<button type="button" class="btn btn-success addsubject" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Department
</button>
<div class="container"> 
<!-- Modal -->

<input class="form-control" type="text" placeholder="Search By Department OR Dean Name" aria-label="default input example" id="serachsubject">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
  <div class="showlaertmssage">

</div>
    <div class="modal-content " >
      <div class="modal-header ">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Department</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input class="form-control widthnew" type="text" placeholder="Department name" aria-label="default input example" required id="Department">
      <br>
      <input class="form-control widthnew" type="text" placeholder="Persone Incharge" aria-label="default input example" required id="PersoneIncgarge">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="okbtn">Ok</button>
      </div>
    </div>
  </div>
</div>





 
<table class="table table-striped  showserachresult">



        <?php if(mysqli_num_rows($mysqliquery) == 0 )
        {
            ?>
 <center>   <img src="../images/departmentimage.svg" class="svgimage"></center>
 <p class="newtext">No departments added yet</p>

<?php
                
            } else{
                ?>
<thead>
            <tr>
            <th scope="col">Department Name</th>
            <th scope="col">Dean</th>
            <th scope="col">Delete</th>
            <th scope="col"></th>
      

            </tr>
        </thead>




        <tbody>
                <?php
                while($rows = mysqli_fetch_assoc($mysqliquery))
                
                {
                    ?>
                         <tr  > 
                       <td><?php echo $rows['departmentName'] ; ?></td>
                       <td><?php echo $rows['dean'] ; ?></td>
                       <td> <input class="form-check-input  " <?php if($rows["status"]=='1'){echo "checked" ; }?>     onclick="departmentToggleStatus(<?php echo $rows['depaermentID'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                       <td> <a href="update_departmet.php?depaermentID=<?php echo $rows['depaermentID'] ;?> & departmentName=<?php echo $rows['departmentName'] ;?> &  dean=<?php echo $rows['dean'] ;?>" class="btn btn-outline-success"  ><img src="../images/update_hwfy7ndx85t2.svg" alt="" id="imageupdate"></a></td>




                </tr>



<?php

                }
            }
            
            ?>






     
    </tbody>

        </tbody>

  </table>
  <?php 
   
   for($btn=1;$btn<=$numberofpages;$btn++){
    echo '<button class="btn btn-dark mx-1 my-3"><a href="department.php?page='.$btn.'" class="text-light blackbtns"  >'.$btn.'</a></button>';
}
   
   
   ?>



 

 
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



    <script type="text/javascript" src="serchdepartment.js"></script>
<script type="text/javascript" src="Themainpreloader.js"></script>
<script type="text/javascript" src="Insert_New_Depertment.js"></script>
<script type="text/javascript" src="departmentToggleStatus.js"></script>


</body>
</html>