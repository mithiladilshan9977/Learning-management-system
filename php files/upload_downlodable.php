<?php 
 
 if(isset($_POST['submit'])){
    include("databaseconn.php");
    session_start();

       $lecturerID =  $_SESSION['lectureID'];
          $subjectID = $_SESSION['subjectID_new'];
          $batchID = $_SESSION['batchID_new'];


        $sql = "SELECT * FROM lecture WHERE lectureID='$lecturerID'";
        $query = mysqli_query($conn , $sql);
        $Lecturdata =  mysqli_fetch_assoc($query);
           $LectutuFname = $Lecturdata['firstname'];
           $LectutuLname = $Lecturdata['lastname'];

           $LectuurFullname = $LectutuFname.' '.$LectutuLname;




       $typedfilename = $_POST['typedfilename'];
       $typeddexcription = $_POST['typeddexcription'];

      
        $filename = $_FILES['formFile']['name'];
        $fileTemName = $_FILES['formFile']['tmp_name'];
        $filesize = $_FILES['formFile']['size'];
        $fileEroor = $_FILES['formFile']['error'];
        $fileTyepe = $_FILES['formFile']['type'];

        $fileExtention  = explode('.' , $filename);
        $fileActualExtention = strtolower($fileExtention['1']);

        $allowed = array('pdf');

        if(in_array($fileActualExtention , $allowed)){
                         if($fileEroor ===0){
                           if($filesize <1000000){
                            $filename =  $typedfilename;
                            $fileDest = 'uploads/' . $filename.'.'.$fileActualExtention;
                            move_uploaded_file($fileTemName , $fileDest);

                            $newsql1 = "INSERT INTO file(fileLocation,fileDate,fileDescription,lecturerID,batchID,subjectID,fileName,uploadedBy) VALUES ('$fileDest' , NOW() , '$typeddexcription' , '$lecturerID','$batchID','$subjectID', '$filename' , '$LectuurFullname') ";

                            $newquery1=mysqli_query($conn,$newsql1);
                                 if($newquery1){
                                     echo "<script>window.location.href='downlodable.php?'</script>";
                                 }
                           }else{
                            echo "File is too large";
                           }
                         }else{
                            echo "There is an error";
                         }
        }else{ 
            echo "File extention failed";
        }

 }

?>