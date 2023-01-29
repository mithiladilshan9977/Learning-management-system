<?php 
include("databaseconn.php");
session_start();

$thebtnvalue = $_POST['thebtnvalue'];
$sql = "SELECT * FROM teacherclassnotification LEFT JOIN studentreplays ON teacherclassnotification.teacherClassNotifiID = studentreplays.teacherNotificationID LEFT JOIN student ON student.studentID = studentreplays.studentID WHERE teacherclassnotification.teacherClassNotifiID='$thebtnvalue'";

$qeury = mysqli_query($conn, $sql);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php 
       if(mysqli_num_rows($qeury) <0)
       {
        echo "no record found";
        
       }else
       {
        while($rowdata = mysqli_fetch_assoc($qeury))
        {
            ?>
        <div class="reply_box border p-2 mb-2">
                <h6 class="username"><small>Replyed on : <?php echo $rowdata['replayedDate'];?> </small> </h6>
                <p class="para"> <?php echo $rowdata['messagetext'];?></p>
          
                <button value =" "  class="badge btn btn-success reply_btn" id="replaybtn">Said : <?php echo $rowdata['firstname'].' '.$rowdata['lastname'];?></button>
                
                 
                 
       </div>

<?php
        }
       }
    
    
    ?>
</body>
</html>