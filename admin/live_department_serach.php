<?php   
include("dbconection.php");

$inputText = $_POST['inputrText'] ; 

$sql = "SELECT * FROM deprtment WHERE departmentName LIKE '{$inputText}%'  OR  dean LIKE '{$inputText}%'";
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
   <div class="dw">

   <table class="table table-striped">

   <thead>
            <tr>
            <th scope="col">Department Name</th>
            <th scope="col">Dean</th>
            <th scope="col">Delete</th>
            <th scope="col"></th>
            </tr>
        </thead>
    <tbody>
      <?php 
       while($rows = mysqli_fetch_assoc($query))
       
       {
        ?>
                 <tr> 
                 <td><?php echo $rows['departmentName'] ; ?></td>
                       <td><?php echo $rows['dean'] ; ?></td>
                       <td> <input class="form-check-input  " <?php if($rows["status"]=='1'){echo "checked" ; }?>     onclick="departmentToggleStatus(<?php echo $rows['depaermentID'];?>),  isCkecked()" type="checkbox" role="switch" id="check"></td>
                       <td> <a href="update_departmet.php?depaermentID=<?php echo $rows['depaermentID'] ;?> & departmentName=<?php echo $rows['departmentName'] ;?> &  dean=<?php echo $rows['dean'] ;?>" class="btn btn-outline-success"  ><img src="../images/update_hwfy7ndx85t2.svg" alt="" id="imageupdate"></a></td>
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