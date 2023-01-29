

<?php

 
if(!isset($_SESSION['studentID'])){
   header('location:student_logout.php');
       die();
}else{
   $currentTime = time();
   if($currentTime > $_SESSION['SESSION_ACTIVE_TIME'] ){
       session_destroy();
       session_unset();
       header('location:student_logout.php');
       die();
   }
}



?>



 
 
