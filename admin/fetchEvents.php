<?php 
include("dbconection.php");

// Filter events by calendar date 
$where_sql = ''; 
if(!empty($_POST['start']) && !empty($_POST['end'])){ 
    $where_sql .= " WHERE start BETWEEN '".$_POST['start']."' AND '".$_POST['end']."' "; 
} 
 
// Fetch events from database 
$sql = "SELECT * FROM events $where_sql"; 
$result = $conn->query($sql);  
 
$eventsArr = array(); 
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){ 
        array_push($eventsArr, $row); 
    } 
} 
 
// Render event data in JSON format 
echo json_encode($eventsArr);
?>