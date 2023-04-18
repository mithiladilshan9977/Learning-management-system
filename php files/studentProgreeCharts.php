<?php 
include("databaseconn.php");
session_start();
// error_reporting(0);
require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
  $lecID = $_SESSION['lectureID'];
  $batchID = $_SESSION['batchID_new'];
  $subjectID = $_SESSION['subjectID_new'];
 
}

if(isset($_SESSION['EXAM_PAPER_ID'])){
  $examID = $_SESSION['EXAM_PAPER_ID'];
  
  
}

  $studentID = $_GET['StudentID'];
    $SFname = $_GET['SFname'];
    $SLname = $_GET['SLname'];

    $selectMarksOfstudent = "SELECT * FROM studentexammarks WHERE studentID='$studentID' ORDER BY SubjectMarks ASC";
    $selectMarksOfstudent_run = mysqli_query($conn ,$selectMarksOfstudent) ;
    
    
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("boostrap.php")?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
 
    <title>Progress report</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Subject', 'Marks' ],
         <?php 
         while($data = mysqli_fetch_assoc($selectMarksOfstudent_run))
         {
            $subjectNmae = $data['SubjectName'];
            $subjectMarks = $data['SubjectMarks'];

            ?>
                   ['<?php echo $subjectNmae ;?>', <?php echo $subjectMarks ;?> ],
            <?php
         }
         ?>
       
        ]);

        var options = {
        
          chart: {
            title: '   ',
            subtitle: ' '
          },
          bars: 'vertical', // Required for Material Bar Charts.
          series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            x: {
              distance: {label: 'parsecs'}, // Bottom x-axis.
              brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
            }
          }
        };

      var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
      chart.draw(data, options);
    };
    </script>
    


</head>
<style>
 
  .nametext{
    position: relative;
    top: 20px;
    left: 150px;
  }
</style>
<body>
   
<?php include("innerpreloader.php");?>
<?php include("lecturer_header.php")  ?>

<?php include("my_students_nav.php")  ?>

<p class="nametext">Progress report of <?php echo $SFname. ' '.$SLname  ?></p>

<div id="dual_x_div"    style="width:50%; margin: 0px auto; margin-top: 50px; height: 500px;"></div>
 


</body>
</html>
