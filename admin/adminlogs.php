
<?php 
include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }
$sqlquery = "SELECT * FROM adminlogs";
$mysqliquery = mysqli_query($conn , $sqlquery);

$BDnumberRows=mysqli_num_rows($mysqliquery);
$rowsperpage = 10;
$numberofpages=ceil($BDnumberRows/$rowsperpage);



if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page=1;
}

$statrpoint=($page-1)*$rowsperpage;
$sqlquery = "SELECT * FROM adminlogs LIMIT ".$statrpoint.','.$rowsperpage;
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
    .tablediv{
        float: right;
        width: 75vw;
        position: relative;
        margin-top: 17px;
    }
    .container{
        margin-top: 20px;
    }
    .title{
        position: relative;
        margin-left: 150px;
        margin-top: 20px;
        z-index: -1;
    }
    .blackbtns{
        text-decoration: none;
         
    }
  

    </style>
<link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Admin logs</title>
</head>
<body>
<?php  include("admin_preloader.php") ;?>
<?php include("adminheadermenu.php") ?>
<?php include("adminNavigationMenu.php")?>

<h1 class="title">Admin Logs</h1>


<div class="container">
<table class="table table-striped showserachresult">
<thead>
            <tr>
            <th scope="col">Admin name</th>
            <th scope="col">Logged In Date</th>
            <th scope="col">Logged Out Date</th>
           

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
                           <td><?php echo $rows['adminusername'] ; ?></td>
                           <td><?php echo $rows['logindate'] ; ?></td>
                           <td><?php echo $rows['logoutdate'] ; ?></td>
                           
    
    
    
    
                    </tr>
    
    
    
    <?php
    
                    }
                }
                
                ?>
    
    
    
    
    
    
         
        </tbody>

        
</table>
    
<?php 

for($btn=1;$btn<=$numberofpages;$btn++){
    echo '<button class="btn btn-dark mx-1 my-3 btnclass"><a href="adminlogs.php?page='.$btn.'" class="text-light blackbtns"  >'.$btn.'</a></button>';
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
</body>
</html>