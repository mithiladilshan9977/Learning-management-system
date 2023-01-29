<?php
 
include("dbconection.php");
 

 $theusername = $_POST['theusername'];
 $thepassword = $_POST['thepassword'];
 $persogn_signIn = $_POST['person'];
 


 $sql = "SELECT * FROM adminn WHERE username='$theusername' AND password='$thepassword'AND person='$persogn_signIn'";
 $query = mysqli_query($conn , $sql);

 $thedata =  mysqli_fetch_assoc($query);

 
  
 
 if(!$theusername && !$thepassword){
    echo '<div class="alert alert-danger" role="alert">
     All fields are required
  </div>';
 }
 else if (!$theusername){
    echo '<div class="alert alert-danger" role="alert">
      No user name
  </div>';
 }else if (!$thepassword){
    echo '<div class="alert alert-danger" role="alert">
   No password
  </div>';
 }
 else if (mysqli_num_rows($query) == 0 ){
    echo '<div class="alert alert-danger" role="alert">
     Invalid credentials
  </div>';
 }
 else  {
     session_start();
       $_SESSION['username'] = $thedata['username'];
       $_SESSION['AId'] = $thedata['AId'];

       $adminID = $thedata['AId'];
       $theadminname = $_SESSION['username'];

       $newsql = "INSERT INTO adminlogs (adminusername , logindate	,adminID  ) values ('$theadminname' , NOW() , '$adminID')";
       $newquery = mysqli_query($conn , $newsql);

  
   $person = $thedata['person'];
   if($person == 'admin')
   {
      $adminusername = $thedata['person'];
      echo '<script>swal("GO -Xm Admin Penal", "Successfully Logged In") 
      setTimeout(goback , 2000);
      function goback(){ window.location.href="adminhomepage.php";};
      
       
      </script>';
   }else if($person == 'coordinator'){
        $_SESSION['DEPERTMENTID'] =  $thedata['departmentID'];
      $coordinatername = $thedata['person'];
     
      echo '<script>swal("GO -Xm Coordinator  Penal", "Successfully Logged In") 
      setTimeout(goback , 2000);
      function goback(){ window.location.href="subjects.php";};
      
       
      </script>'; 
   }else{
      echo '<script>swal("GO -Xm", "Person is unknown") 
      
      
       
      </script>'; 
   }

        

   

   


 } 
?>