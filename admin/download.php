<?php 
session_start();
include("dbconection.php");

 
if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }

$sql = "SELECT * FROM file";
$sql_run = mysqli_query($conn, $sql);
$dbnumberodRows = mysqli_num_rows($sql_run);
$rowsPerPage = 10;
$numberOFPages = ceil($dbnumberodRows / $rowsPerPage);

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$statringposint = ($page - 1) * $rowsPerPage;

$sql = "SELECT * FROM file LIMIT ".$statringposint.' , '.$rowsPerPage ;
$sql_run = mysqli_query($conn, $sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Downloadable Files</title>
    <?php include("boostrapJquery.php"); ?>
    <style>
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

<h1 class="title">Downloadable Files</h1>


<div class="container mt-4">


<table class="table table-striped showserachresult">

           

        <?php 
        if(mysqli_num_rows($sql_run)==0)
        {
           ?>
                   
                   <center>   <img src="../images/nofiles.svg" class="svgimage"></center>
 <p class="newtext">No uploded files yet 😥</p>
<?php  
        }else
        {?>
<thead>
            <tr>
            <th scope="col">File Name</th>
            <th scope="col">Description</th>
            <th scope="col">Uploaded By</th>
            <th scope="col">Uploaded Date</th>
            <th></th>
   

            

            </tr>
        </thead>

        <tbody>

<?php
            while($rows = mysqli_fetch_assoc($sql_run))
            {
                ?>
<tr> 
                       <td><?php echo $rows['fileName'] ; ?></td>
                       <td><?php echo $rows['fileDescription'] ; ?></td>
                       <td><?php echo $rows['uploadedBy'] ; ?></td>
                       <td><?php echo $rows['fileDate'] ; ?></td>
                       <td><a href="../php files/uploads/<?php echo $rows['fileDescription']; ?>.pdf" target="_blank">Download</a> </td>
                    
                      




                </tr>


<?php
            }
        }
        
        
        ?>

        </tbody>
</table>
<?php 
for($bbtn=1;$bbtn<=$numberOFPages;$bbtn++){
    echo '<button class="btn btn-dark mx-1 my-3"><a href="download.php?page='.$bbtn.'" class="text-light blackbtns"  >'.$bbtn.'</a></button>';
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