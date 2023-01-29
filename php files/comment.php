<?php 
 include("databaseconn.php");
 session_start();
 
 
 $array_result = ["dawdwd"];
 
if(isset($_POST['load_comment'])){
 
    echo  $studentID = $_SESSION['studentID'];
    echo  $subjectID = $_SESSION['subjectID'];

    $sql = "SELECT * FROM student WHERE studentID='$studentID'";
    $query = mysqli_query($conn, $sql);
   
    $data = mysqli_fetch_assoc($query);
    $batch = $data['batchID'];

    
     $comment_query = "SELECT * FROM teacherclassnotification LEFT JOIN lecture ON teacherclassnotification.teacherID=lecture.lectureID  WHERE subjectID='$subjectID' AND btachID='$batch'";

     $comment_query_run = mysqli_query($conn, $comment_query);
     
  
    if(mysqli_num_rows($comment_query_run) > 0){

        foreach($comment_query_run as $row){
            $teacherID = $row['teacherID'];
            $teacher_query = "SELECT * FROM lecture WHERE lectureID='$teacherID' LIMIT 1";
            $teacher_query_run = mysqli_query($conn, $teacher_query);
            $teacher_result = mysqli_fetch_array($teacher_query_run);

            array_push($array_result, ['cmt'=>$row, 'teacher'=>$teacher_result]);

        }
        header('Content-Type:application/json');
        echo json_encode($array_result);

    }else{
        echo "No data commennt";
    }
}

?>