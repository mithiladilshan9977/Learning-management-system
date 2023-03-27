<?php 
include("databaseconn.php");

$sql = "SELECT * FROM batch";
$query = mysqli_query($conn , $sql);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrap.php")?>
    
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
        background-image: url("images/campus background.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }
    .container{
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-direction: row;;
        flex-wrap: wrap;
    }
    .imagediv{
        width: 500px;
        height: 620px;
        margin-top: 20px;
        background-size: cover;
        background-image: url("../images/vitaliy-nqyK3NuwC6E-unsplash.jpg");
    }
    .form{
        margin: 20px;
        width: 500px
    }
    .showmessage{
        position: relative;
        width: 100%;
    }
    .thepasswordeye{
      position: relative;
    top: -31px;
    right: -469px;
    }
    .thepasswordeye:hover{
      cursor: pointer;
    
    }
    @media (max-width :650px){
      .imagediv{
        display: none;
      }
     body{
        
        background-size: cover;
        background-image: url("../images/vitaliy-nqyK3NuwC6E-unsplash.jpg");
      }
      .form{
        background-color: rgba(255, 255, 255, 0.345);
        padding: 10px;
        border-radius: 10px;
      }
      .thewaring{
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.601);
        color: black;
        border-radius: 15px;
      }

      .thepasswordeye{
      position: relative;
    top: -31px;
    right: -424px;
    }
    .thepasswordeye:hover{
      cursor: pointer;
    
    }


    }
        </style>
         <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Student Sign in</title>
</head>
<body>
<?php include("innerpreloader.php");?>

    <div class="container">

    <div class="imagediv">

    </div>
    <div class="form">
        
 <div class="showmessage">

</div>
    <h5 class="my-2"> Go-Xm student Registration</h5>
  
    <input class="form-control" type="text" placeholder="Index number" aria-label="default input example" id="indexnumber" required>
    <br>
    <input class="form-control" type="text" placeholder="First name" aria-label="default input example" id="firstnmae" required>
    <br>
    <input class="form-control" type="text" placeholder="Last name" aria-label="default input example" id="lastname" required>
    <br>
           <select class="form-select" aria-label="Default select example" id="selectbatch" required>
            <option selected>Select Batch</option>
         <?php 
         while($row = mysqli_fetch_assoc($query))
         
         {?>
                         <option value="<?php echo $row['BatchID'] ; ?>"><?php echo $row['NameOfBatch'] ; ?></option>

      <?php   }
         ?>

           
          
            </select>
            <br>
    <input class="form-control" type="password" placeholder="Password" aria-label="default input example" id="password" required> <i class="fa-solid fa-eye thepasswordeye" id="eye"></i>
    <br>
    <input class="form-control" type="password" placeholder="Re-Enter password" aria-label="default input example" id="reenterpassword" required>
<br>
      <button id="submit" class="btn btn-primary">Confirm</button>
      
      <a href="../index.php?" class="btn btn-info">Have an account</a>
      <b><p style="color: red; margin-top: 10px ;  "  class="thewaring">You have to get the permission from the Admin first.</p></b>
     
      </div>
      </div>


   

 
    <script type="text/javascript">
 
      var eye = document.getElementById("eye");
      var password = document.getElementById("password");
       
      eye.addEventListener('click', function () {
         password.setAttribute('type','text');
         eye.classList.add("fa-regular fa-eye-slash");
         eye.classList.remove("fa-solid fa-eye");



      })
    </script>
    <script src="studentsignin.js"></script>


</body>
</html>