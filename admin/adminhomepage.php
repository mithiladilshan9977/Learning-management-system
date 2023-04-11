<?php
 session_start();
 error_reporting(0);
 if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }
 include("dbconection.php");

 $sql = "SELECT * FROM subject";
 $query = mysqli_query($conn , $sql);
 $allrows = mysqli_num_rows($query);

$sqlsubject1 = "SELECT * FROM subject WHERE status='0'";
$sqlsubject1_RUN = mysqli_query($conn, $sqlsubject1);
$subjectonerows = mysqli_num_rows($sqlsubject1_RUN);
 

  try {
    $subjectPrecetage = ceil(($subjectonerows / $allrows) * 100);
 
    echo $subjectPrecetage;  
  } catch (DivisionByZeroError $e) {
    
  }

  

 $sqltwo = "SELECT * FROM student";
 $departmentquery = mysqli_query($conn , $sqltwo);
 $studentsAll = mysqli_num_rows($departmentquery);

 $notZerosql = "SELECT * FROM student WHERE oneandzero='0'";
$notZerosql_run = mysqli_query($conn, $notZerosql);
$zeroRows = mysqli_num_rows($notZerosql_run);
$studentprecentage = ceil(($zeroRows / $studentsAll) * 100);





 $sqlthree= "SELECT * FROM lecture";
 $batchquery = mysqli_query($conn , $sqlthree);
 $lectureAll = mysqli_num_rows($batchquery);

 $sqlthreeZero= "SELECT * FROM lecture WHERE lectstatus='0'";
 $sqlthreeZero_run = mysqli_query($conn , $sqlthreeZero);
 $lectureZeroo = mysqli_num_rows($sqlthreeZero_run);
$lecturePrecetage = ceil(($lectureZeroo / $lectureAll) * 100);



 
 $sqltfour= "SELECT * FROM batch";
 $batchquery_new = mysqli_query($conn , $sqltfour);
 $batch = mysqli_num_rows($batchquery_new);

 $sqltfourZero = "SELECT * FROM batch WHERE status='0'";
 $sqltfourZero_run = mysqli_query($conn , $sqltfourZero);
 $batchzerooo = mysqli_num_rows($sqltfourZero_run);



try {
    $batchprecentage = ceil(($batchzerooo / $batch) * 100);
 
    echo $batchprecentage;  
  } catch (DivisionByZeroError $e) {
     
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrapJquery.php"); ?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Home Page</title>
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
    #navtitle{
        color: white;
    }
    .container{
       
        margin: 0px auto;
        margin-top: 40px;
         
    }
    .progress{
        width: 30vw;
    }
    .title{
        position: relative;
        margin-left: 150px;
        margin-top: 20px;
        display: inline;
        z-index: -1;
    }
    .outerdiv{
        width: 1000px;
        height: 300px;
        z-index: -1;
        display: flex;
        position: relative;
        flex-wrap: wrap;
        margin: 0px auto;
        justify-content: space-evenly;
        align-items: center;
        flex-direction: row;
        margin-top: 30px;
    }
    .innerdivs{
   border-radius: 10px;
    height: 100%;
    width: 250px;
    box-shadow: 1px 1px 20px 10px rgba(0, 0, 0, 0.375);
    margin: 10px;
    border: 2px solid rgba(0, 0, 0, 0.444);

    }
    
.students{
    background-color: white;
}
.subject{
    background-color: white;
}
 .lecturers{
    background-color: white;
 }
 .batches{
    background-color: white;
 }
 .innerstudent{
    position: relative;
     width: 100%;
    height: 200px;
    background-color: red;
    background-image: url("../images/download.png");
    background-size: cover;
 }
 .innersubject{
    position: relative;
     width: 100%;
    height: 200px;
    background-color: red;
    background-image: url("../images/dwa.jpg");
    background-size: cover;
 }
.innerlecturer{
    position: relative;
     width: 100%;
    height: 200px;
    background-color: red;
    background-image: url("../images/eqweqw.jfif");
    background-size: cover;
}
.innerbathes{
    position: relative;
     width: 100%;
    height: 200px;
    background-color: red;
    background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%,url());
    background-image: url("../images/pattern-background-colorful-shape.jpg");
    background-size: cover;
}
.maintitles{
    position: absolute;
    bottom: -45px;
    left: 15px;
    font-size: 27px;
   
}
.backdiv{
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.137);
}
.progress{
    position: absolute;
    bottom: -80px;
    left: 10px;
    width: 80%;
}
.compltedtitle{
    position: absolute;
    bottom: -77px;
    left: 10px; 
    font-size: 13px;
}
   
    </style>
</head>
<body>


    
<?php  include("admin_preloader.php") ;?>





    <?php include("adminheadermenu.php") ?>





 <?php include("adminNavigationMenu.php")?>

 <h1 class="title">DashBoard</h1>

<div class="container outerdiv">
    <div class="students innerdivs">
          <div class="innerstudent">
            <div class="backdiv">
            <h2 class="maintitles">Students</h2>
            <p class="compltedtitle">Active</p>
            <div class="progress">
            <?php 
 if($studentprecentage <= 20)
 {
    ?>
<div class="progress-bar bg-danger" role="progressbar" aria-label="Example with label" style="width: <?php echo $studentprecentage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $studentprecentage?>%</div>
</div>
    <?php
 }else if($studentprecentage > 20 && $studentprecentage <=75 )
 {
    ?>
<div class="progress-bar bg-warning" role="progressbar" aria-label="Example with label" style="width: <?php echo $studentprecentage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $studentprecentage?>%</div>
</div>
    <?php
 } 
 else
 {
    ?>
<div class="progress-bar bg-success" role="progressbar" aria-label="Example with label" style="width: <?php echo $studentprecentage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $studentprecentage?>%</div>
</div>
    <?php
 }
 
 
 ?>

            </div>
          </div>

    </div>
    <div class="subject innerdivs">
        <div class="innersubject">
        <div class="backdiv">
            <h2 class="maintitles">Subjects</h2>
             <p class="compltedtitle">Active</p>
            <div class="progress">



            <?php 
 if($subjectPrecetage <= 20)
 {
    ?>
<div class="progress-bar bg-danger" role="progressbar" aria-label="Example with label" style="width: <?php echo $subjectPrecetage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $subjectPrecetage?>%</div>
</div>
    <?php
 }else if($subjectPrecetage > 20 && $subjectPrecetage <=75 )
 {
    ?>
<div class="progress-bar bg-warning" role="progressbar" aria-label="Example with label" style="width: <?php echo $subjectPrecetage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $subjectPrecetage?>%</div>
</div>
    <?php
 } 
 else
 {
    ?>
<div class="progress-bar bg-success" role="progressbar" aria-label="Example with label" style="width: <?php echo $subjectPrecetage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $subjectPrecetage?>%</div>
</div>
    <?php
 }
 
 
 ?>
 
            </div>
            
        </div>
    </div>
    <div class="lecturers innerdivs">
        <div class="innerlecturer">
        <div class="backdiv">
            <h2 class="maintitles">Lecturers</h2>
            <p class="compltedtitle">Active</p>
            <div class="progress">


            <?php 
 if($lecturePrecetage <= 20)
 {
    ?>
<div class="progress-bar bg-danger" role="progressbar" aria-label="Example with label" style="width: <?php echo $lecturePrecetage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $lecturePrecetage?>%</div>
</div>
    <?php
 }else if($lecturePrecetage > 20 && $lecturePrecetage <=75 )
 {
    ?>
<div class="progress-bar bg-warning" role="progressbar" aria-label="Example with label" style="width: <?php echo $lecturePrecetage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $lecturePrecetage?>%</div>
</div>
    <?php
 } 
 else
 {
    ?>
<div class="progress-bar bg-success" role="progressbar" aria-label="Example with label" style="width: <?php echo $lecturePrecetage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $lecturePrecetage?>%</div>
</div>
    <?php
 }
 
 
 ?>
 
            </div>
        </div>
    </div>
    <div class="batches innerdivs">
        <div class="innerbathes">
        <div class="backdiv">
            <h2 class="maintitles">Batches</h2>

            <p class="compltedtitle">Active</p>
            <div class="progress">
            <?php 
 if($batchprecentage <= 20)
 {
    ?>
<div class="progress-bar bg-danger" role="progressbar" aria-label="Example with label" style="width: <?php echo $batchprecentage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $batchprecentage?>%</div>
</div>
    <?php
 }else if($batchprecentage > 20 && $batchprecentage <=75 )
 {
    ?>
<div class="progress-bar bg-warning" role="progressbar" aria-label="Example with label" style="width: <?php echo $batchprecentage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $batchprecentage?>%</div>
</div>
    <?php
 } 
 else
 {
    ?>
<div class="progress-bar bg-success" role="progressbar" aria-label="Example with label" style="width: <?php echo $batchprecentage?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $batchprecentage?>%</div>
</div>
    <?php
 }
 
 
 ?>




  

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



    <script type="text/javascript" src="Themainpreloader.js"></script>

</body>
</html>