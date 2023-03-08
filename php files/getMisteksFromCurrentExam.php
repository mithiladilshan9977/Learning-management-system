<?php
 
 
include("databaseconn.php");
session_start();
require("lectetrSESSION.php");
 

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
    $lecID = $_SESSION['lectureID'];
    $batchID = $_SESSION['batchID_new'];
    $subjectID = $_SESSION['subjectID_new'];
  
  }


    $theExam = $_POST['theExamIdnew'];

$selectStudentSQL = "SELECT * FROM  student LEFT JOIN  detectexam ON detectexam.studentID = student.studentID WHERE examid='$theExam' AND subjectid='$subjectID'";
$selectStudentSQL_run = mysqli_query($conn, $selectStudentSQL);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>


    <style>
      .maincontainer{
        background-color: black;
        width: 100%;
      }
      .numbeofstudents{
        color: rgba(255, 0, 0, 0.982);

      }
      </style>
</head>
 
<body>
  
 
 

<table class="table table-striped showserachresult">


        
        <?php
        if(mysqli_num_rows($selectStudentSQL_run) == 0)
        {
          ?>
           <center> <p>We are looking over the exam...</p> </center>
           <center> <small>No records found yet. Once found they will appear here.</small> </center>
   
<?php
             
        }else
        {
          ?>
<thead>
                  <p >Number of students detected <span class="numbeofstudents"><?php echo mysqli_num_rows($selectStudentSQL_run)?></span></p>
                <tr>
                <th scope="col">Index Number</th>
                <th scope="col">Student Name</th>
                <th scope="col">Mistakes Made</th>
         
                </tr>
            </thead>

<?php
            while($rows = mysqli_fetch_assoc($selectStudentSQL_run))
            {
                ?>
      
            <tbody>

                <tr> 
                           <td><?php echo $rows['indexnumber'] ; ?></td>
                           <td><?php echo $rows['firstname'] .' '. $rows['lastname'] ; ?></td>
                           
                           <td><?php echo $rows['mistakes'] ; ?></td>
                   
                      </tr>
    
    
    <?php
            } 
        }
           
        
        ?>
     
</table>
</tbody>
 
 
</body>
</html>