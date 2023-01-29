<?php 

include("databaseconn.php");
session_start();
$duration = "";
$selectnewtimmer = "SELECT * FROM examinformation";
$res = mysqli_query($conn, $selectnewtimmer);
$row = mysqli_fetch_assoc($res);
$duration = $row['minutesnew'];
 

$_SESSION['duration'] = $duration;
$_SESSION['start_time'] = date("Y-m-d H:i:s");

$endTime = date('Y-m-d H:i:s', strtotime('+' . $_SESSION['duration'] . 'minutes', strtotime($_SESSION['start_time'])));


$_SESSION['END_TIME'] = $endTime;


?>
 <script type="text/javascript">
  
    window.location="questions.php";
 </script>
