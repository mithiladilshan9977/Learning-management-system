<?php 
include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }
$sqlquery = "SELECT * FROM adminn WHERE status='0'";
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
 $sqlquery = "SELECT * FROM adminn WHERE status='0' LIMIT ".$statringpoint.',' .$rowsperpage;
 $mysqliquery = mysqli_query($conn , $sqlquery);
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
    #imageupdate{
        width: 20px;
        height: 20px;
    }
    .title{
        position: relative;
        margin-left: 150px;
        margin-top: 20px;
    }
    .blackbtns{
        text-decoration: none;
    }
    </style>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Admin Users</title>
</head>
<body>
<?php  include("admin_preloader.php") ;?>
<?php include("adminheadermenu.php") ?>
<?php include("adminNavigationMenu.php")?>
<h1 class="title">Admin Users</h1>
    <div class="container">


   
<table class="table table-striped showserachresult">
       
       

   <?php if(mysqli_num_rows($mysqliquery) == 0 ){
               echo '<tr><div class="alert alert-danger" role="alert">
               No Records Found
             </div></tr>'; 
           } else
           {?>
<thead>
           <tr>
           <th scope="col">Username</th>
           <th scope="col">First name</th>
           <th scope="col">Last name</th>
          
           <th scope="col">Delete</th>

           </tr>
       </thead>
   <tbody>
           <?php
               while($rows = mysqli_fetch_assoc($mysqliquery))
               
               {
                   ?>
                        <tr  > 
                      <td><?php echo $rows['username'] ; ?></td>
                      <td><?php echo $rows['firstname'] ; ?></td>
                      <td><?php echo $rows['lastname'] ; ?></td>
                      
                      <td> <input class="form-check-input  " <?php if($rows["status"]=='1'){echo "checked" ; }?>     onclick="admintoggleStatus(<?php echo $rows['AId'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                      <td> <a href="update_adminusers.php?AId=<?php echo $rows['AId']; ?> & username=<?php echo $rows['username'];?> & firstname=<?php echo $rows['firstname'] ;?> & lastname=<?php echo $rows['lastname'] ; ?>  " class="btn btn-outline-success" ><img src="../images/update_hwfy7ndx85t2.svg" alt="" id="imageupdate"></a></td>




               </tr>



<?php

               }
           }
           
           ?>






    
   </tbody>
        

     </table>
     <?php 
     for($btn=1;$btn<=$numberofpages;$btn++){
        echo '<button class="btn btn-dark mx-1 my-3"><a href="adminusers.php?page='.$btn.'" class="text-light blackbtns"  >'.$btn.'</a></button>';
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





<script type="text/javascript" src="admintoggleStatus.js"></script>
<script type="text/javascript" src="Themainpreloader.js"></script>

</body>
</html>