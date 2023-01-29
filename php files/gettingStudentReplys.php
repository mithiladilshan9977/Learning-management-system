<?php 
 include("databaseconn.php");
 session_start();


 $studentID = $_SESSION['studentID'];
$ClickeBtnValue = $_POST['ClickeBtnValue'];

$selectql = "SELECT * FROM studentreplays LEFT JOIN student ON studentreplays.studentID=student.studentID WHERE  teacherNotificationID='$ClickeBtnValue'";
$sqlquery_run = mysqli_query($conn, $selectql);
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>


#showthedate{
    color: gray;
    font-weight: 100;
    margin-left: 20px;
}
        </style>
</head>
<body>

<?php 
if(mysqli_num_rows($sqlquery_run) <0){
    echo "No data";
}else{
    while($rowsata = mysqli_fetch_assoc($sqlquery_run))
    {
        ?><div class="sub_reply_box border-bottom p-2 mb-2">
                    <h6 class="username" id="showthedate">  <small>Replyed : on  <?php echo $rowsata['replayedDate']; ?></small></h6>
                    <p class="para"><?php echo $rowsata['messagetext']; ?></p>
                    <button value =" "  class="badge btn btn-success sub_reply_btn">Replyed By  <?php echo $rowsata['firstname'].' '.$rowsata['lastname'] ; ?></button>
                    <div class="ml-4 sub_reply_Section">
                    </div>
                    </div>
          <?php
    
            

    }
}


?>

</body>
</html>