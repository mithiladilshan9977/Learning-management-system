<?php 
 session_start();
 include("databaseconn.php");
 require("lectetrSESSION.php");
 if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
}
?>

 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrap.php"); ?>
    <title>Downloadables</title>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
   
     <style>

.addsubject{
            position: fixed;
            right: 25px;
            top: 65px;
            z-index: 100;
            
            
        }
        .container{
          margin-top: 70px;
        }
        </style>
</head>
<body>
<?php include("innerpreloader.php");?>
<?php include("lecturer_header.php")  ?>

<?php include("my_students_nav.php")  ?>


<button type="button" class="btn btn-success   addsubject" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Upload File
</button>

 

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="message">

    </div>
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
 
            <form action="upload_downlodable.php" method="post" enctype="multipart/form-data"> 
    
                                        <div class="mb-3">
                                <label for="formFile" class="form-label">Select your file</label>
                                <input class="form-control" type="file" name="formFile" required accept=".pdf">
                                </div>

                     
                        <label for="" class="form-label">Name of file</label>
                        <input class="form-control" type="text" placeholder="Name file" aria-label="default input example" name="typedfilename"   required>
                  

                         <label for="" class="form-label">Discription</label>
                        <input class="form-control" type="text" placeholder="Description" aria-label="default input example" name="typeddexcription" required >
 
      </div>
      <div class="modal-footer">
        <button   class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button   class="btn btn-primary" name="submit">Add</button>

        </form>
      </div>
    </div>
  </div>
</div>

   
 
   <?php 
   
   $subjectID = $_SESSION['subjectID_new'];
   $batchID = $_SESSION['batchID_new'];


  $selectSql = "SELECT * FROM file WHERE subjectID='$subjectID' AND batchID='$batchID' AND  filestatus ='0' order by fileDate DESC";
  $selectQuery = mysqli_query($conn , $selectSql);

   
   
   
   
   
   if(mysqli_num_rows($selectQuery) == 0 ){
                 
    ?>
    <center>
  <img src="../images/undraw_transfer_files_re_a2a9.svg" alt="" srcset="" style="width: 350px; height: 350px; margin-top: 30xpx;"> 

  <p class="mt-2">No added files yet</p>
  </center>
<?php
            } else{
                while($rows = mysqli_fetch_assoc($selectQuery))
                
                {
                    ?>
                     <div class="container">


<table class="table table-striped showserachresult">

          <thead>
          <tr>
          <th scope="col">File Name</th>
          <th scope="col">Description</th>
          <th scope="col">Uploaded By</th>
          <th scope="col">Uploaded Date</th>
          <th></th>
          <th></th>

          

          </tr>
      </thead>


      <tbody>


                         <tr  > 
                       <td><?php echo $rows['fileName'] ; ?></td>
                       <td><?php echo $rows['fileDescription'] ; ?></td>
                       <td><?php echo $rows['uploadedBy'] ; ?></td>
                       <td><?php echo $rows['fileDate'] ; ?></td>
                       <td><a href="<?php echo $rows['fileLocation'] ; ?>" target="_blank">Download</a> </td>
                       <td> <input class="form-check-input" <?php if($rows["filestatus"]=='1'){echo "checked" ; }?>     onclick="filetoggleStatus(<?php echo $rows['fileID'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                      




                </tr>



<?php

                }
            }
            
            ?>
    
   </tbody>

      </table>

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
<script type="text/javascript" src="filetoggleStatus.js"></script>
    
</body>
</html>