<?php
 
 
 
 include("dbconection.php");
session_start();
if(!isset($_SESSION['username'] )){
    echo "<script>window.location.href = 'index.php'</script>";
    die();
 }else{
     $adminID = $_SESSION['AId'];
 }

 

 //ENCRYPT FUNCTION
 

// Include the qrlib.php file
require_once('../php files/phpqrcode/qrlib.php');
$selectadmin = "SELECT * FROM adminn where AId='{$adminID}'";
$selectadmin_run = mysqli_query($conn ,$selectadmin);
$getdatnewdata = mysqli_fetch_assoc($selectadmin_run);
 
 
$data =  $getdatnewdata['password'] ;

;

// Set the size and margin of the QR code
$size = 10;
$margin = 1;

// Generate the QR code image
QRcode::png($data, 'qrcode.png', QR_ECLEVEL_L, $size, $margin);

// Output the QR code image to the browser
header('Content-Type: image/png');
readfile('qrcode.png');
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Your QR code</title>
</head>
<style>
 
</style>
<body>
 
</body>
</html>
