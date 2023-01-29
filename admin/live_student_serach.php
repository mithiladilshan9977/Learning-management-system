<?php   
include("dbconection.php");

$inputText = $_POST['inputrText'] ; 

$sql = "SELECT batch.* , student.* FROM batch INNER JOIN student ON batch.BatchID = student.batchID WHERE   oneandzero = '0' AND firstname LIKE '{$inputText}%' OR lastname LIKE '{$inputText}%' OR indexnumber LIKE '{$inputText}%' OR batch.NameOfBatch LIKE '{$inputText}%' ";
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
    #imageupdate{
        width: 20px;
        height: 20px;
    }
    
</style>
   </head>
   <body>
   <div class=" ">

   <table class="table table-striped">

   <thead>
            <tr>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Batch name</th>
            <th scope="col">Index number</th>
            <th scope="col">Status</th>
            <th scope="col">Delete</th>
            <th scope="col"> </th>
            </tr>
        </thead>
    <tbody>
      <?php 
       while($rows = mysqli_fetch_assoc($query))
       
       {
        ?>
                 <tr> <td><?php echo $rows['firstname'] ; ?></td>
                       <td><?php echo $rows['lastname'] ; ?></td>
                       <td><?php echo $rows['NameOfBatch'] ; ?></td>
                       <td><?php echo $rows['indexnumber'] ; ?></td>
                       <td><?php echo $rows['status'] ; ?></td>
                       <td> <input class="form-check-input  " <?php if($rows["oneandzero"]=='1'){echo "checked" ; }?>     onclick="studenttoggleStatus(<?php echo $rows['studentID'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                       <td> <a href="update_student.php?studentID=<?php echo $rows['studentID'] ; ?> & stuFname=<?php echo $rows['firstname'] ; ?> & stuLname=<?php echo $rows['lastname'] ; ?> & NameOfBatch=<?php echo $rows['NameOfBatch'] ; ?> & indexnumber=<?php echo $rows['indexnumber'] ; ?> " class="btn btn-outline-success"  ><img src="../images/update_hwfy7ndx85t2.svg" alt="" id="imageupdate"></a></td>
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