<?php

 
 if(!isset( $_SESSION['lectureID'])){
    header('location:lecturer_logout.php');
        die();
 }else{
    $currentTime = time();
    if($currentTime >$_SESSION['LECTUTR_SESSION_ACTIVE_TIME'] ){
        session_destroy();
        session_unset();
        header('location:lecturer_logout.php');
        die();
    }
 }
 
 

?>