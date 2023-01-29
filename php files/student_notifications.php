<?php 
 include("databaseconn.php");
 session_start();
 
 require("sessionTime.php");

 if(!isset($_SESSION['studentID'] )){
    header("location:../index.php");
  }
 
  

    if(isset($_SESSION['subjectID'])){
            $subjectID = $_SESSION['subjectID'];
    }else{
             $subjectID = 0;
    }
    if(isset($_SESSION['studentID'])){
           $studentID = $_SESSION['studentID'];
     }else{
    $studentID = 0;
     }
   
  


 

 $sql = "SELECT * FROM student WHERE studentID='$studentID'";
 $query = mysqli_query($conn, $sql);

 $data = mysqli_fetch_assoc($query);
 

 try{
    if(!$data){
        throw new Exception("Batch session has been exprired", 1);
        
    }
    $batch = $data['batchID'];
 }catch(Exception $e){
    echo $e->getMessage();
 }
  $comment_query = "SELECT * FROM teacherclassnotification INNER JOIN lecture ON teacherclassnotification.teacherID=lecture.lectureID  WHERE subjectID='$subjectID' AND btachID='$batch'";

  $comment_query_run = mysqli_query($conn, $comment_query);
 
 
 
//   if(mysqli_num_rows($comment_query_run) > 0){

//     foreach($comment_query_run as $row){
//   $teacherID = $row['teacherID'];
//         $teacher_query = "SELECT * FROM lecture WHERE lectureID='$teacherID' LIMIT 1 ";
//         $teacher_query_run = mysqli_query($conn, $teacher_query);
//         $data = mysqli_fetch_array($teacher_query_run);
//         $name = $data['content'];

         

//     }
     

// }else{
//     echo "No data commennt";
// }



 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Notifications</title>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <style>
 
 
.msaagediv{
    background-color: rgba(0, 0, 0, 0.123);
    padding: 5px;
}
.postedDate{
    position: relative;
    margin-top: 5px;
    display: inline;
}
#dateimage{
    width: 20px;
    height: 20px;
    margin-left: 10px;
    transition: 0.2s all ease-in-out;
}
.container:hover #dateimage{
    transition: 0.2s all ease-in-out;
    transform: scale(1.5);
}
#anchortag{
    position: relative;
    margin-left: 10px;
    text-decoration: none;
 
}
.replymessagediv{
  
    position: relative;
    margin-left: 20px;
    margin-top: 7px;
}
#anchortag:hover{
   
     color: rgb(0, 31, 205);
}
.replaymessage{
    color: rgb(0, 31, 205);
}
.reply_Section{
    display: none;
}
#showthedate{
    color: gray;
    font-weight: 100;
    margin-left: 20px;
}
.showstudentreplays{
    display: none;
}
    </style>
    <?php include("boostrap.php"); ?>
</head>
<body>
<?php include("innerpreloader.php");?>

<?php include("student_header.php")  ?>

<?php include("student_naviga_bar.php")  ?>

     
 
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                         <div class="card">



                            <div class="card-header">
                                <h6>Class Notificatios</h6>
                            </div>
                            <div class="card-body">
                                 
                            

                                  <hr>
                                  <div class="comment_container">
                               
                                  <?php 
                                  if(mysqli_num_rows($comment_query_run) < 0)
                                  {
                                    ?>
                                <h1>No records found</h1>
                                    <?php
                                  }
                                  else
                                  {
                                    while($rowdata = mysqli_fetch_assoc($comment_query_run))
                                    {
                                        ?>
                                         <div class="reply_box border p-2 mb-2">
                <h6 class="username"><small>Posted By : <?php echo $rowdata['firstname'] . ' ' . $rowdata['lastname']; ?></small> <small id="showthedate">  Date : <?php echo $rowdata['date']; ?></small></h6>
                <p class="para"> <?php echo $rowdata['content'];?></p>
                <button value ="<?php echo $rowdata['teacherClassNotifiID'];?>"  class="badge btn btn-warning reply_btn" id="replaybtn">Reply</button>
                <button value ="<?php echo $rowdata['teacherClassNotifiID'];?>"  class="badge btn btn-danger view_reply_btn">View replays</button>
                <div class="showstudentreplays">

                <div class="sub_reply_box border-bottom p-2 mb-2">
                    <h6 class="username">Mithila dilshan</h6>
                    <p class="para">Replay message</p>
                    <button value =" "  class="badge btn btn-success sub_reply_btn">Replyed</button>
                    <div class="ml-4 sub_reply_Section">
                    </div>
                    </div>

                </div>
                <div class="ml-4 reply_Section">
                    
                                <div class="maincomment">
                                    <textarea name="" id="" rows="1" class="commecnt_text_box form-control mt-2" placeholder="Send a replay to <?php echo $rowdata['firstname'].' '.$rowdata['lastname'];?>"></textarea>
                                    <button type="button" class="btn btn-primary add_comment_btn mt-3">Send Repaly</button>
                                </div>
             </div>
       </div>

                                        <?php
                                    }
                                  }
                                  
                                  
                                  
                                  ?>
                         




                                  
       
                                </div>
                            </div>
                         </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>
  function addDarkmodeWidget() {
    new Darkmode().showWidget();
  }
  window.addEventListener('load', addDarkmodeWidget);
</script>

<script type="text/javascript"> 
    const options = {
  bottom: '64px', // default: '32px'
  right: 'unset', // default: '32px'
  left: '32px', // default: 'unset'
  time: '0.5s', // default: '0.3s'
  mixColor: '#fff', // default: '#fff'
  backgroundColor: '#fff',  // default: '#fff'
  buttonColorDark: '#100f2c',  // default: '#100f2c'
  buttonColorLight: '#ffff54', // default: '#fff'
  saveInCookies: true, // default: true,
  label: '🌓', // default: ''
  autoMatchOsTheme: true // default: true
}

const darkmode = new Darkmode(options);
darkmode.showWidget();

 
</script>
 
<script type="text/javascript" src="replaycomment.js"></script>

</body>
</html>