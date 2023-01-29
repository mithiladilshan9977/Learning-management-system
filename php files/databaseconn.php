<?php
$servername = "localhost";
$username = "root";
$passowrd = "";
$dbname = "newstudentexampaper";

$conn = mysqli_connect($servername, $username, $passowrd, $dbname);

if(!$conn){
   echo "Connection failed";
}

?>