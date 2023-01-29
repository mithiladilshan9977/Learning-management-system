<!-- <?php 
session_start();
include("databaseconn.php");
$form_time1 = date('Y-m-d H:i:s');

$to_time1 = $_SESSION['END_TIME']; 
 

$timefirst = strtotime($form_time1);
$timeseconds = strtotime($to_time1);

$diffecrceinseconds = $timeseconds - $timefirst;

echo gmdate("H:i:s" , $diffecrceinseconds);



?> -->