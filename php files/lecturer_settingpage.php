<?php 

include("databaseconn.php");
session_start();
  // require("lectetrSESSION.php");

if (!isset($_SESSION['lectureID'])) {
    header("location:../index.php");
    die();

}

$selectClassImageSQL = "SELECT * FROM classimage";
$selectClassImageSQL_run = mysqli_query($conn, $selectClassImageSQL);


$sql = "SELECT * FROM batch";
$query = mysqli_query($conn , $sql);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <?php include("boostrap.php")?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <style>
        .newul{
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-wrap: wrap;
            
        }
        .newul li{
            list-style: none;
        }
        .wrapper{
            overflow-y: scroll;
            display: none;
        }
        .newlink{
            text-decoration: none;
            color: black;
        }
        .newlink:hover{
            color: black;
        }
        .newlinknew{
            text-decoration: none;
            color: black;
        }
        .newlinknew:hover{
            color: black;
        }
        .classimage{
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }
        .classimage:hover{
            border: 5px solid rgba(0, 15, 221, 0.463);
            transition: all 0.2s ease-in-out;
        }
        .good{
            color: green; 
           font-weight: bold;
        }
        .bad{
            color: red; 
           font-weight: bold;
        }
    </style>
</head>
<style>
    
</style>
<body>
<?php include("innerpreloader.php");?>

<?php include("lecturer_header.php")  ?>

<?php include("lecturer_naviga_bar.php")  ?>


<div class="container mt-5" style="width: 900px;   padding: 5px;"> <h3>Settings</h3></div>


<div class="container mt-3" style="width: 500px;  border: 2px solid rgba(0, 0, 0, 0.267); padding: 5px;">
<h6 class="mb-2">Preferences</h6>
   <hr>

   <a href="#" class="mt-1 newlink">Select class image</a> 

   <div class="wrapper mt-1" style="background-color: rgba(216, 216, 216, 0.349); height: 200px; width: 100%;">
<ul class="newul">


    <?php 
     while($imagedata = mysqli_fetch_assoc($selectClassImageSQL_run))
     {
        ?>
<li class="newlist" ><input type="hidden" value="<?php echo $imagedata['classimageid']; ?>" class="imageid"> <img src="<?php echo $imagedata['imagepath']; ?>" alt="" class="img-thumbnail  classimage bordeerimage" style="width: 150px; height: 150px; margin: 2px;" data-bs-toggle="modal" data-bs-target="#exampleModalnew" ></li>

 

<div class="modal fade" id="exampleModalnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
   
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Select Batch</h1>   <small class="showimagemessage" style="margin-left: 18px;"></small>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <label for="">Select Batch</label>
                            <select class="form-select theoprionValue" aria-label="Default select example" id="selectedbatch">
                        <?php 
                        while($rows = mysqli_fetch_assoc($query))
                         {
                            ?>

                                      <option value="<?php echo $rows['BatchID'] ; ?>"><?php echo $rows['NameOfBatch'] ; ?></option>
                                 

                      <?php  }
                        
                        ?>
                        
                      
                        </select>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success setimage">Set Image</button>
      </div>
    </div>
  </div>
</div>



        <?php
     }
    
    ?>
    



     
</ul>



   </div>
   <div> <a href="#" class="mt-1 newlinknew" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"   >Change Password</a>


    


</div>




<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="inserterrormessage"></div>
      <div class="modal-header">
       
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="" class="my-2">Current Password</label>   <small class="showthemessage"></small>
        <input type="text" class="form-control mb-1" required id="currentpassword">

        <label for="" class="my-2">New Password</label> <small class="showthemessagenew"></small>
        <input type="password" class="form-control mb-1" required id="newPass">


        <label for="" class="my-2">New Password (again)</label> 
        <input type="password" class="form-control mb-1" required id="newpPassAgain"> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="updatebtn">Update</button>
      </div>
    </div>
  </div>
</div>





 
</p>

  
</div>
</body>
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

<script>

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))



</script>
<script src="curentpassscheck.js"> </script>
<script src="insertNewPass.js"> </script>
<script src="droptheImageDIv.js"></script>
<script src="selectedimagenew.js"></script>
 
</html>


