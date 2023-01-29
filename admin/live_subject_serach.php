<?php   
include("dbconection.php");

$inputText = $_POST['inputrText'] ; 

$sql = "SELECT * FROM subject WHERE title LIKE '{$inputText}%' AND status='0'";
$query = mysqli_query($conn , $sql);

if(mysqli_num_rows($query) > 0){
                     
   ?>

   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
    .tablediv{
        float: right;
        width: 75vw;
        position: relative;
        margin-top: 17px;
    }
    
</style>
   </head>
   <body>
   <div class=" ">

   <table class="table table-striped">

   <thead>
            <tr>
            <th scope="col">Code</th>
            <th scope="col">Suject Title</th>
            <th scope="col">Semester</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
    <tbody>
      <?php 
       while($rows = mysqli_fetch_assoc($query))
       
       {
        ?>
                 <tr> 
                       <td><?php echo $rows['code'] ; ?></td>
                       <td><?php echo $rows['title'] ; ?></td>
                       <td><?php echo $rows['semester'] ; ?></td>
                       <td><?php echo $rows['description'] ; ?></td>
                       <td> <input class="form-check-input  " <?php if($rows["status"]=='1'){echo "checked" ; }?>     onclick="toggleStatus(<?php echo $rows['subjectId'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                       <td> <a href="update_subjects.php?subjectId=<?php echo $rows['subjectId'] ; ?> & code=<?php echo $rows['code'] ;?> & title=<?php echo $rows['title'] ;?> & semester=<?php echo $rows['semester']?> & description=<?php echo $rows['description']?> " class="btn btn-outline-success"  ><img src="../images/update_hwfy7ndx85t2.svg" alt="" id="imageupdate"></a></td>
                </tr>

<?php
       }
      ?>



   </table>


   <div>


   </body>
   </html>





   <?php




}else{
    echo '<br> <div class="alert alert-danger thealertdiv" role="alert">
     No Matching Recoreds
  </div>';  
}
 
?>