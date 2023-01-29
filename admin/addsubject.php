 <?php 
 include("dbconection.php");
 session_start();
 if(!isset($_SESSION['username'] )){
     echo "<script>window.location.href = 'index.php'</script>";
     die();
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
    <title>Add Subject</title>
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
        .containernew{
       position: relative;
            width: 48vw;
            margin: 0px auto;
            float: right ;
            height: 100vh;
            right: 280px;
            background-color: white;
        }
        .inputfilesss{
            width: 450px;
        }
        #newsvgimages{
   position: fixed;
   right: 20px;
   top: 80px;
   text-decoration: none;
   color: rgba(0, 30, 255 , 0.8004);
 
   }
   #newsvgimages:hover{
    text-decoration: underline;
   }
   #newsvgimages > img{
    position: relative;
    width: 20px;
   height: 20px;
   margin-right: 7px;
   }
   .container{
    ;
    margin-top: 12px;
   }
   #maincontainer{
    max-width:800px;
 
   }
   
   
    </style>
</head>
<body>
 
 
<?php include("coordinaterheadermenu.php") ?>
<?php include("coordinaterNavigationMenu.php")?>

<a href="subjects.php" id="newsvgimages"> <img src="../images/back_l2mhb66hdam7.svg" alt=""> Back</a>


 
<div class="container" id="maincontainer">
<div class=" ">
        
        </div>
    <center><h1>Add Subject</h1></center>

        <label for=""><b>Subject Code</b></label>
    <input class="form-control inputfilesss" type="text" placeholder="Subject Code" aria-label="default input example" id="subjectcode">
<br>
    <label for=""><b>Subject Titles</b></label>
    <input class="form-control inputfilesss" type="text" placeholder="Subject Titles" aria-label="default input example" id="subjectTitle">
<br>
<label for=""><b>Select Semester</b></label>
    <select class="form-select" aria-label="Default select example" id="semester">
  <option selected>Select the semester</option>
  <option value="semester1">Semester 1</option>
  <option value="semester2">Semester 2</option>
  
</select>
<br>
<label for=""><b>Description</b></label>
<br>


 
<textarea name=""  cols="80" rows="10" id="discription" class="form-control"></textarea>
     


<br>
<button type="button" class="btn btn-primary" id="addsubjectbtn">Add Subject</button>
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

<script type="text/javascript" src="addsubject.js"></script>
</body>
</html>