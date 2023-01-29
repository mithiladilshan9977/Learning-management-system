<?php 
include("databaseconn.php");
 
session_start();
if(!isset($_SESSION['studentID'] )){
  header("location:../index.php");
}
 if(isset($_GET['subjectID']))
 {
  $subjectID = $_GET['subjectID'];
  $_SESSION['subjectID'] = $subjectID;
 }


if(isset($_POST['notdonrbtn'])){

  $thefileID = $_POST['hiddenfileID'];
  $sqlectFile = "SELECT * FROM file WHERE fileID='$thefileID'";
  $sqlectFile_run = mysqli_query($conn, $sqlectFile);
  $getdata = mysqli_fetch_assoc($sqlectFile_run);
  $chechstatus = $getdata['donestatus'];
  $setnewstatus;
  if($chechstatus=='0'){
    $setnewstatus = 1;
  }else{
    $setnewstatus = 0;
  }
  $fileUpdatesql = "UPDATE file SET donestatus='$setnewstatus' WHERE fileID='$thefileID'";
  $fileUpdatesql_run = mysqli_query($conn, $fileUpdatesql);


 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Downloadable</title>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <?php include("boostrap.php"); ?>
    <style>
.container{
    margin-top: 70px;
}
.crossimage{
  width: 30px;
  height: 30px;
  margin-left: 13px;
}
        </style>
</head>
<body>
<?php include("innerpreloader.php");?>

<?php include("student_header.php")  ?>

<?php include("student_naviga_bar.php")  ?>



   
<div class="container">

 
 
<table class="table table-striped showserachresult">
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
 
 $sql= "SELECT * FROM file WHERE subjectID='$subjectID'";
 $query = mysqli_query($conn ,$sql);

 

   
   if(mysqli_num_rows($query) == 0 ){
                echo '<tr><div class="alert alert-danger" role="alert">
                No Files Found
              </div></tr>'; 
            } else {






                while($data = mysqli_fetch_assoc($query))
                
                   { ?>
                                 <tr>
                                    <th><?php  echo $data['fileName']; ?></th>
                                    <th><?php  echo $data['fileDescription']; ?></th>
                                    <th><?php  echo $data['uploadedBy']; ?></th>
                                    <th><?php  echo $data['fileDate']; ?><a href="<?php echo $data['fileLocation'] ; ?>" target="_blank"><img src="../images/download_vv8m11cborcd.svg" class="img-thumbnail  crossimage" alt="..."></a> </th>

                                     <th>

                                     <form action="#" method="post">
                                      <input type="hidden" value="<?php  echo $data['fileID']; ?>" name="hiddenfileID">
                                      <?php 
                                      if($data['donestatus']=='0')
                                      {
                                        ?>
                                        <button class="badge btn btn-danger" type="submit" name="notdonrbtn">Not done</button>
                                        <?php
                                      }else{
                                        ?>
                                   <button class="badge btn btn-success" type="submit" name="notdonrbtn">Done</button>

<?php
                                      }
                                      
                                      ?>
                                      
                                     </form>
                                      
                                    </th>
                                 </tr>

<?php
                        
                    }
            }
            
            ?>





        </tbody>
</table>




<?php
 



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