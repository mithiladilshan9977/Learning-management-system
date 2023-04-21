<?php 

include("databaseconn.php");
session_start();
error_reporting(0);
require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}else{
  $lecID = $_SESSION['lectureID'];
  $batchID = $_SESSION['batchID_new'];
  $subjectID = $_SESSION['subjectID_new'];
 
}

if(isset($_SESSION['EXAM_PAPER_ID'])){
  $examID = $_SESSION['EXAM_PAPER_ID'];
  
  
}







$selectquesry = "SELECT * FROM question where lectureID='{$lecID}' AND examPaperID='$examID' ";
    $selectquesry_run = mysqli_query($conn ,$selectquesry);
    $getSelectdata = mysqli_fetch_assoc($selectquesry_run);



$selectpaper = "SELECT * FROM examinformation WHERE batchID='{$batchID}' AND lecturID='{$lecID}' and subjectID='{$subjectID}' ORDER BY examPaperID DESC";
$selectpaper_run = mysqli_query($conn, $selectpaper);
$getdata = mysqli_fetch_assoc($selectpaper_run);



$selectpapernewww = "SELECT * FROM examinformation WHERE batchID='{$batchID}' AND lecturID='{$lecID}' and subjectID='{$subjectID}' ORDER BY examPaperID DESC";
$selectpaper_runnnnn = mysqli_query($conn, $selectpapernewww);
$getdataaaa = mysqli_fetch_assoc($selectpaper_runnnnn);


$selectExmas = "SELECT * FROM examinformation WHERE batchID='{$batchID}' AND lecturID='{$lecID}' and subjectID='{$subjectID}' ";
$selectExmas_run = mysqli_query($conn, $selectExmas);

//remove the updating view holder

$removesqlButtonHolder = "SELECT * FROM examinformation WHERE batchID='{$batchID}' AND lecturID='{$lecID}' and subjectID='{$subjectID}' ";
$removesqlButtonHolder_run = mysqli_query($conn, $removesqlButtonHolder);
$getexamdatanewww = mysqli_fetch_assoc($removesqlButtonHolder_run ) ; 

 
 


// select exam paper format
$sqlone = "SELECT  *,COUNT(*) FROM question  WHERE question.examPaperID='$examID' AND deleteornot='0' GROUP BY questionText HAVING COUNT(*) >1 ORDER BY questionNumber ASC";
$sql_run = mysqli_query($conn, $sqlone);
 
$selectLecture = "SELECT lecture.* , deprtment.* FROM lecture LEFT JOIN deprtment ON lecture.departmentID = deprtment.depaermentID WHERE lecture.lectureID='{$lecID}'";
$selectLecture_run = mysqli_query($conn, $selectLecture);
$getLecData = mysqli_fetch_assoc($selectLecture_run);
$LectFName = $getLecData['firstname'];
$LectFLName = $getLecData['lastname'];
$DpaetmentName = $getLecData['departmentName'];


 //get student index number for uqestions uploading
$studentIDArray = [];
$sqlselectBatch = "SELECT student.*, batch.* FROM student LEFT JOIN batch ON student.batchID = batch.BatchID WHERE batch.BatchID = '$batchID'";
$sqlselectBatch_run = mysqli_query($conn, $sqlselectBatch);
if  (mysqli_num_rows($sqlselectBatch_run) > 0){
       while($row= mysqli_fetch_array($sqlselectBatch_run)){
    $studentIDArray[] = $row['studentID'];
       }
}
///import from excel file
$importExcelKey = 'qkrjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

 
function encryptthisExcel($data, $importExcelKey) {
    $encryption_key = base64_decode($importExcelKey);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
    }
    
 
    function decryptthisExcel($data, $importExcelKey) {
    $encryption_key = base64_decode($importExcelKey);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

 

//manually add questions
$manualyKey = 'ekwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

//ENCRYPT FUNCTION
function encryptthismanual($data, $manualyKey) {
    $encryption_key = base64_decode($manualyKey);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
    }
    
    //DECRYPT FUNCTION
    function decryptthismanual($data, $manualyKey) {
    $encryption_key = base64_decode($manualyKey);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

   
      


 use PhpOffice\PhpSpreadsheet\Spreadsheet;
 use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// exam info
if (isset($_POST['uploadExcel'])) {

  $filename = $_FILES['excel']['name'];
  $fileExtention = explode('.', $filename);
  $fileExtention = strtolower(end($fileExtention));

  $newFileName = date("Y.m.d") . "-".date("h.i.sa") . "."  . $fileExtention;
  $targetDirectory = "./examPapersExcelFils/" . $newFileName;
  move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

  error_reporting(0);
  ini_set('display_errors', 0);

  require("../admin/excelReader/excel_reader2.php");
  require("../admin/excelReader/SpreadsheetReader.php");

  $reader = new SpreadsheetReader($targetDirectory);


 foreach($reader as $key => $row){
     $hours = $row[0];
    $minutes = $row[1];
    $passowrd = $row[2];
    $papername = $row[3];
    $limiteTo = $row[4];

   
    $newsqlInsert = "INSERT INTO examinformation (batchID , lecturID, subjectID, hoursnew,minutesnew,password,paperName,showGreenCorrect,limitTo) VALUES('$batchID','$lecID','$subjectID','$hours','$minutes','$passowrd','$papername','1','$limiteTo')";
    $newsqlInsert_run = mysqli_query($conn , $newsqlInsert);
    






    if($newsqlInsert_run){

  echo "<script>alert('File uploaded successfully')</script>";
 


      
     }
   $selectHigtVal = "SELECT MAX(examPaperID) as examPaperID_new FROM examinformation";
    $selectHigtVal_run = mysqli_query($conn ,$selectHigtVal);
    $resultnew = mysqli_fetch_assoc($selectHigtVal_run);
      $hightExamPaper = $resultnew['examPaperID_new'];
     

        //php composer excel
 require 'vendor/autoload.php';
 $spreadsheet = new Spreadsheet();
 $activeWorksheet = $spreadsheet->getActiveSheet();
 $activeWorksheet->setCellValue('A1', $hightExamPaper);
 $activeWorksheet->setCellValue('B1', '1');
 $activeWorksheet->setCellValue('C1', 'Start write your questions from here');
 
 $writer = new Xlsx($spreadsheet);
 $writer->save('Questions.xlsx');

 echo "<script>window.location.href='addExamPpaer.php'</script>";

 }  
 }






 // exam question upload

 
if (isset($_POST['uploadExcel_question'])) {

  $filename = $_FILES['excel_question']['name'];
  $fileExtention = explode('.', $filename);
  $fileExtention = strtolower(end($fileExtention));

  $newFileName = date("Y.m.d") . "-".date("h.i.sa") . "."  . $fileExtention;
  $targetDirectory = "./examPapersExcelFils/" . $newFileName;
  move_uploaded_file($_FILES['excel_question']['tmp_name'], $targetDirectory);

  error_reporting(0);
  ini_set('display_errors', 0);

  require("../admin/excelReader/excel_reader2.php");
  require("../admin/excelReader/SpreadsheetReader.php");

  $reader = new SpreadsheetReader($targetDirectory);
 
 
 foreach($reader as $key => $row){
   
    
  $PaperID = $row[0];
  $questionumber_new = $row[1];
  $questionText = $row[2];
  $encrptedQuestion =  encryptthisExcel($questionText, $importExcelKey);
  
  foreach($studentIDArray as $StudentIndexNum){
    $StudentIndexNum;
    $insertQuestion = "INSERT INTO question(examPaperID,questionNumber,lectureID,studentID,questionText) VALUES('$PaperID','$questionumber_new','$lecID','$StudentIndexNum', '$encrptedQuestion')";
    $insertQuestion_run = mysqli_query($conn ,$insertQuestion);
}

if($insertQuestion_run ){
  echo "<script>alert('Question file uploaded successfully')</script>";
  echo "<script>window.location.href='addExamPpaer.php'</script>"; 
}

}

  
 }

 // add question options

if (isset($_POST['uploadExcel_question_options'])) {

  $updateSQL = "UPDATE examinformation SET status='1' WHERE batchID='{$batchID}' AND lecturID='{$lecID}' AND subjectID='{$subjectID}'" ;
  $updateSQL_run = mysqli_query($conn, $updateSQL);

  $filename = $_FILES['excel_question_options']['name'];
  $fileExtention = explode('.', $filename);
  $fileExtention = strtolower(end($fileExtention));

  $newFileName = date("Y.m.d") . "-".date("h.i.sa") . "."  . $fileExtention;
  $targetDirectory = "./examPapersExcelFils/" . $newFileName;
  move_uploaded_file($_FILES['excel_question_options']['tmp_name'], $targetDirectory);

  error_reporting(0);
  ini_set('display_errors', 0);

  require("../admin/excelReader/excel_reader2.php");
  require("../admin/excelReader/SpreadsheetReader.php");

  $reader = new SpreadsheetReader($targetDirectory);

   $optionArray = [];
   $theAnswer="";
    
  foreach($reader as $key => $row ){

    $examPpaperID= $row[0];
    $questioNumber = $row[1];

        $optionArray[0] = encryptthisExcel($row[2],$importExcelKey);
        $optionArray[1] = encryptthisExcel($row[3],$importExcelKey);
        $optionArray[2] = encryptthisExcel($row[4],$importExcelKey);
        $optionArray[3] = encryptthisExcel($row[5],$importExcelKey);
        $optionArray[4] = encryptthisExcel($row[6],$importExcelKey);

    $theAnswer = encryptthisExcel($row[7],$importExcelKey);

    foreach($studentIDArray as $StudentIndexNum){
      $StudentIndexNum;
  
      foreach($optionArray as $questionOptions){
   
        
  
      if(decryptthisExcel($questionOptions,$importExcelKey) == decryptthisExcel($theAnswer,$importExcelKey)){
         $is_correct = 1;
      }else{
          $is_correct = 0;
      }
      $insertQuestion = "INSERT INTO questionoptions(examPaperID,questionNumber,lectureID,studentID,options,is_correct) VALUES('$examPpaperID','$questioNumber','$lecID','$StudentIndexNum', '$questionOptions','$is_correct')";
      $insertQuestion_run = mysqli_query($conn ,$insertQuestion);
  
        if ($insertQuestion_run) {
    
          continue;
          
      } else {
          echo die("Error occured !");
      }
  
      }
     
        
     }
  }
  
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Exams</title>
    <?php include("boostrap.php")?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.all.min.js">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
</head>
<style>
    .dropdownmenu{
        position: absolute;
        width: 500px;
        height: 600px;
        right: 10px;
        top: 110px;
        border-radius: 10px;
        box-shadow: 1px 1px 10px 1px rgba(0, 0, 0, 0.175);
        background-color: white;
    }
    .dropdownmenu{
        display: none;
    }
    #dropdownimage{
            opacity: 0.4;
            width: 100%;
            height: 100%;
position: absolute;
            text-align: center;
            margin: 0px auto;
        }
        .refreshwaring{
          font-size: 15px;
          margin-left: 10px;
          opacity: 0.7;
          color: red;
        }
       .navigateToUpload{
        width:100%;
       }
       .stepTitle{
        background-color: rgba(0, 232, 249, 0.252);
        border-radius:15px;
        padding: 15px;
        font-size: 17px
    }
    .guideline{
        margin: 2px 0px 2px 10px;
        font-size: 15px
    }
    #excelfile{
      display: none;
    }

    #excelfile_question{
      display: none;
    }

    #excelfile_question_options{
      display: none;
    }
    #examInforForm{
       
        text-align: center;
        margin: 18px auto;

    }
    .examinforimage{
        margin: 5px;
     
   
    }
    .maintitleMain{
        margin: 10px;

    }
    #downloadicon{
      width:30px ;
        height:30px;
         margin:5px ;
         position:relative ;
    }

    #cirrecticon{
      width:30px ;
        height:30px;
         margin-left:10px;
         position:relative ;
    }
#startExamBTtn{
  position:absolute;
  left:0px;
  margin-left:10px;
}
#fileuplaodicon{
  position: relative;
}
#questiouploadicon{
  position: relative;

}
#optionsIconsshows{
  position: relative;

}
.buttonsHolder{
 background-color: blue;
 background-color: rgba(45, 45, 255, 0.175);
 border-radius: 15px;
 padding: 15px;
}
 .deletdquestionmessge{
  position: fixed;
  width:100%;
 top: 0px;
 }
 .delecticon{
  width: 40px;
  height:40px;
  padding: 5px;
  cursor: pointer;
  margin-left: 10px;
  border-radius: 50%;
 transition: all 0.1s ease-in-out;

 }
 .delecticon:hover{
 transition: all 0.1s ease-in-out;

  background-color: rgba(45, 45, 255, 0.275);

 }
</style>
<body>
<?php include("innerpreloader.php");?>
<?php include("lecturer_header.php")  ?>

<?php include("my_students_nav.php")  ?>

 <!-- Button trigger modal -->
   <div class="showthemessage"></div>

 <div class="containerrrrr" style="float: right; right: 10px; position: absolute; top:70px">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Add New Paper
</button>
</div>

<div class="containerrrrr" style="float: right; right: 150px; position: absolute; top:70px">
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalprint">
Print
</button>
</div>

<div class="containerrrrr" style="float: right; right: 214px; position: absolute; top:70px" >
<button type="button" class="btn btn-info" id="chekbowdropdown" >
Exams
</button>
</div>


<div class="containerrrrr" style="float: right; right: 293px; position: absolute; top:70px" >
<a href="checkCurrentExam.php?examPaperID=<?php echo $getdataaaa['examPaperID'];?> & paperName=<?php echo $getdataaaa['paperName'];?>" class="btn btn-danger">Watch</a>
 
</div>

<div class="containerrrrr" style="float: right; right: 370px; position: absolute; top:70px" >
<button type="button" class="btn btn-secondary" id="chekbowdropdown" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
Excel
</button>
</div>

<!-- // excel file upload model -->




<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content" >
      <div class="modal-header" >
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Follow given guidelines</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"  >
       

      <p class="stepTitle">Step 1    
    
      <?php 

      if($getdata['paperName'] !="")

      {
        ?>
      <img src="../images/correcticon.png" id="cirrecticon" style=""/>


<?php
      }
      
      ?>
    
    
    </p>
<center>
<img src="../images/examinformation.png" class="img-thumbnail examinforimage" alt="..."> </center>
 
<p class="guideline">  <img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put time hours in <b>A1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put time minutes in <b>B1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put password in <b>C1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put subject name in <b>D1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put number of questions you want to limit in <b>E1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Import excel file by pressing <b>'Import Excel'</b> button & upload</p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>  Download the file after uploading</p>


<center>

    </center>
<!-- // upload the exam info -->
<form action="addExamPpaer.php" method="post" enctype="multipart/form-data" id="examInforForm">
    
   
  <input type = "file"   id="excelfile" accept=".xlsx"  name="excel" required>
  <img src="../images/uploadDone.png" style="width:20px ; height:20px; right:10px" id="fileuplaodicon"/>     <label for="excelfile" class="btn btn-primary"  >Import Excel</label>
            <input type="submit" value="Upload" class="btn btn-success" name="uploadExcel" required>

   
 </form>

 <center>

 <?php 
      if($getdata['paperName'] != "")
      {
        ?>
      <a href="./Questions.xlsx" download><img src="../images/downloadicon.png" id="downloadicon" style=""/></a>



<?php
      }
      
      ?>



 </center>


<!-- 
<form action="uploadExamExcelFile.php" method="post">
<input type="submit" value="Download" class="btn btn-success" name="export_excel"  >

</form> -->



<!-- // upload question -->

<p class="stepTitle">Step 2


<?php  
   
    
      if($getSelectdata['questionText'] !="")
      {
        ?>
      <img src="../images/correcticon.png" id="cirrecticon" style=""/>

        <?php
      }
      ?>

</p>
<center>
<img src="../images/questionsPNG.PNG" class="img-thumbnail examinforimage" alt="..."> </center>
 
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Exam paper ID appears automatically in <b>A1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Put question number in <b>B1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Write the question in <b>C1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Import excel quetion file by pressing <b>'Import Excel Question'</b> button & upload</p>

<form action="addExamPpaer.php" method="post" enctype="multipart/form-data" id="examInforForm">
       <input type = "file"   id="excelfile_question"  accept=".xlsx" name="excel_question" required>
       <img src="../images/uploadDone.png" style="width:20px ; height:20px; right:10px" id="questiouploadicon"/>       <label for="excelfile_question" class="btn btn-primary"  >Import Excel Question</label>
         <input type="submit" value="Upload question" class="btn btn-success" name="uploadExcel_question" required>
   
 </form>



 <!-- // upload options -->


 <p class="stepTitle">Step 3</p>
<center>
<img src="../images/optionspaper.PNG" class="img-thumbnail examinforimage" alt="..."> </center>
 
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Exam paper ID appears automatically in <b>A1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Put question number in <b>B1 cell</b>(should be 5 question)</p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Write the options in <b>C1 cell</b> to <b>G1 cell</b>  </p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Copy & past the answer in <b>H1 cell</b></p>

<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Import excel quetion file by pressing <b>'Import Excel options'</b> button & upload</p>




<!-- add oprions -->
<form action="addExamPpaer.php" method="post" enctype="multipart/form-data" id="examInforForm">
        
 <input type = "file"   id="excelfile_question_options"  accept=".xlsx" name="excel_question_options" required>
 <img src="../images/uploadDone.png" style="width:20px ; height:20px; right:10px" id="optionsIconsshows"/>  <label for="excelfile_question_options" class="btn btn-primary"  >Import Excel options</label>
<input type="submit" value="Upload options" class="btn btn-success" name="uploadExcel_question_options" required>

</form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
 
      </div>
    </div>
  </div>
</div>
 
 
<div class="dropdownmenu">
 

  <table class="table table-striped  ">
  

    <tbody>
        
    <?php if(mysqli_num_rows($selectExmas_run) == 0 ){
                echo '<img src="../images/undraw_appreciation_re_n3c1.svg " id="dropdownimage">';
        echo '<br>';
        echo '<center><h1>No Records Yet !</h1></center>';
        echo '<br>';
        echo '<center><h6>They will appear here </h6></center>';
            } else
            
            {?>
<thead>
            <tr>
            <th scope="col">Paper Name</th>
            <th scope="col"></th>
            </tr>
    </thead>

 
               <?php while($rows = mysqli_fetch_assoc($selectExmas_run))
                
                {
                    ?>
                         <tr> 
                 
                       <td><?php echo strtoupper($rows['paperName'])   ; ?></td>
                    
                       <td> <button class="btn btn-danger removebtn" data-bs-toggle="modal" data-bs-target="#exampleModalnew" value="<?php echo $rows['examPaperID']?>"  >REMOVE</button> </td>
                      

                       <div class="modal fade" id="exampleModalnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="showtherrror"></div>
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Paper</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Do you want to remove the exam paper ? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger removepaper"  >Remove</button>
      </div>
    </div>
  </div>
</div>


                </tr>



<?php

                }
            }
            
            ?>
    </tbody>
    </table>

</div>



<div class="deletdquestionmessge"></div>

 


<div class="container" style="margin-top: 50px; width: 100%;">

   <h4 class="nameofthePaper"><?php
   if(mysqli_num_rows($selectpaper_run)==0)
   {
    ?>  
    <center>
      <img src="../images/undraw_detailed_examination_re_ieui.svg" alt="" srcset="" style="width: 350px; height: 350px; margin-top: 80px;">
      <p class="" style="font-size:17px; margin-top:20px">Make New Exam Paper !</p>

    </center>
    <?php
   }else{
   
    echo   strtoupper($examName = $getdata['paperName']) . "<small class='refreshwaring'>If the created paper is not visible, please refresh</small>" ;
      $_SESSION['EXAM_PAPER_ID'] = $getdata['examPaperID'];
   }
   
   
   ?></h4>

</div>

<div class="questionTemplteLoad"></div>


 
<?php 
$counterplus =1;
if(mysqli_num_rows($sql_run) !== 0) {
 
 ?>
 
<div class="container" style="width: 800px; margin-top: 70px;  border: 1px solid black;  padding: 15px;">


<div class="header"  style="background-color: rgba(168, 168, 168, 0.325); padding: 10px; margin-bottom: 10px;">
<center>
  <img src="../images/camp.png" alt="" srcset="" class="thumbnail-img my-1" style="width: 150px; height: 150px;">
   <h2>Lecturer : <?php echo $LectFName .' ' .$LectFLName ?></h2>
   <h2>Saegis Campus</h2>
  

</center>
<p>Date : <?php echo  date("Y-m-d") ?> (<?php echo date("Y-M-D")?>)</p>
</div>
 <?php

} 
?>

<?php while($hetquestion = mysqli_fetch_assoc($sql_run))
{
 ?>
 
<h6>
  <?php echo  $counterplus;?> ) 
  <?php 
      if($getSelectdata['uploadByExcelOrnot'] == 1 )
      {
        echo decryptthismanual($hetquestion['questionText'],$manualyKey);  

      }else{
        echo decryptthisExcel($hetquestion['questionText'],$importExcelKey);  

      }

 
 
?>
</h6>

  <?php 
  $question = $hetquestion['questionNumber'];
  $selectoprion = "SELECT * FROM questionoptions WHERE questionNumber='$question' AND examPaperID='{$examID}'";
  $selectoprion_run = mysqli_query($conn, $selectoprion);
  
  for($s = 1 ; $s<=5 ;$s++)
  {
   ?>
 <p style="margin-left: 20px;">
 
 <?php
 
     $newtdaa = mysqli_fetch_assoc($selectoprion_run);

   if($getSelectdata['uploadByExcelOrnot'] == 1 )
   {
    echo $s . '. ' . decryptthismanual($newtdaa['options'],$manualyKey);     

   }else{
    echo $s . '. ' . decryptthisExcel($newtdaa['options'],$importExcelKey);     

   }
  
       
       ?> 
       
        <?php if ($newtdaa['is_correct'] == '1')
         { ?> 
       <img src="../images/correct_bb6njyhdw0rf.svg" alt="" srcset="" style="width: 20px; height: 20px;">
       
       <?php }   ?>  
      
      
      </p>
   <?php
  }
  ?>

<?php 
 
 if($getexamdatanewww['startNowExam'] == 0)
 {
  ?>
<div class="buttonsHolder mb-3">
    <span class="singelResposeHolder"></span>

<input type="hidden" class="thisIsTheQuestionNumber" value=<?php echo $hetquestion['questionNumber'];?> >
 
 <button class="btn btn-success my-2 updateAfterCreatedBtn"  >Update</button>
   <img src="../images/questiondelete.png" class="delecticon delteQuestion"> 

</div>

<?php
 }

?>

  




<?php
 





 $counterplus ++;



}

?>


<div class="modal fade" id="exampleModalprint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 

      <div class="modal-header">
        
        <h1 class="modal-title fs-5" id="exampleModalLabel">Take Print Exam Paper</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <?php   if (mysqli_num_rows($selectpaper_runnnnn) ==0)
      {
        ?>
            <center><p>No Papers To Print.</p></center>
        <?php
      }
      ?>
<a href="printPage.php?examPaperID=<?php echo $getdataaaa['examPaperID'];?> & paperName=<?php echo $getdataaaa['paperName'];?>" style="text-decoration: none;"><?php echo $getdataaaa['paperName'];?></a>

      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


 
 
 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="showthemesssgae"></div>

      <div class="modal-header">
        
        <h1 class="modal-title fs-5" id="exampleModalLabel">Exam Paper Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <label for="">Name of Exam Paper</label>
       <input type="text" class="form-control my-2" placeholder="Name of Exam" id="nameofpaper" required >

       <label for="">Time Period (Hours)  </label>
       <input type="text" class="form-control my-2" placeholder="Time In Hours" style="width: 58%; display: inline-flex; margin-left: 16px;" id="timeInHours" required>

       <label for="">Time Period (Minutes)</label>
       <input type="text" class="form-control my-2" placeholder="Time In Minutes" style="width: 58%; display: inline-flex;" id="timeInMinutes" required>

       <label for="">Start Password</label>
       <input type="text" class="form-control my-2" placeholder="This is used to start the exam" id="startPassword" required>

       <label for="">End Password</label>
       <input type="text" class="form-control my-2" placeholder="This is used to end the exam" id="closesPassword" required>


        

       <label for="">Limit to</label>
       <input type="number" class="form-control my-2" placeholder="Questions limit" id="limiteTo" min="1" max="50" required>

       <label for="">Number Of Questions</label>
       <input type="number" name="" id="numberofuqestion" class="form-control my-2" min="1" max="50" placeholder="Number of Questions">
       <img src="../images/plus_7uy2lzykpxf9.svg" alt="" srcset="" style="width: 35px; height: 35px; cursor: pointer;" id="getNumnerOFforms">

   <b>   <span style="color: red;">(Add this after creating the paper)</span> </b>

      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-info" data-bs-dismiss="modal" id="startExamBTtn">Create</button>
     <span class="startBtton"></span>
    
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="savebtn">Add info</button>
      </div>
      

    </div>
  </div>
</div>

  

</div>

<script type="text/javascript">
  
  var theUpladoStatusIcon = document.getElementById("fileuplaodicon");
  theUpladoStatusIcon.style.display ="none";
  document.getElementById("excelfile").addEventListener("change", function(){
 const reader = new FileReader();

 reader.addEventListener("load", () =>{
 localStorage.setItem("examPaperInfo", reader.result);
 const getImageUrl = localStorage.getItem("examPaperInfo");
  if(getImageUrl){
    theUpladoStatusIcon.style.display ="inline-block";
  }
 });
 reader.readAsDataURL(this.files[0])
  });


 
 
    </script>
<script type="text/javascript">
  //upload questions
  var questionUploadIcon = document.getElementById("questiouploadicon");
  questionUploadIcon.style.display ="none";

  document.getElementById("excelfile_question").addEventListener("change", function(){
    const reader = new FileReader();
    reader.addEventListener("load", () =>{
 localStorage.setItem("questionofpaper", reader.result);
 const getImageUrlnew = localStorage.getItem("questionofpaper");
  if(getImageUrlnew){
    questionUploadIcon.style.display ="inline-block";
  }
 });
 reader.readAsDataURL(this.files[0])
  });
  

    </script>


<script type="text/javascript">

  //upload options
  var optionsIconsshows = document.getElementById("optionsIconsshows");
  optionsIconsshows.style.display ="none";

  document.getElementById("excelfile_question_options").addEventListener("change", function(){
    const reader = new FileReader();
    reader.addEventListener("load", () =>{
 localStorage.setItem("questionoptions", reader.result);
 const getImageUrlnew = localStorage.getItem("questionoptions");
  if(getImageUrlnew){
    optionsIconsshows.style.display ="inline-block";
  }
 });
 reader.readAsDataURL(this.files[0])
  });
  

    </script>




 <script>
 $(document).ready(function () {
 
  var hours = 0;
  var addonehours = hours + 1;
  var munites = 0.1;
  var seconds = addonehours * munites * 60;
 
//  const startingNinutes = 10;
//  let time = startingNinutes * 60;

 var obj = setInterval(setUp , 1000);


  function setUp(){

    if(seconds ==0){
      clearInterval(obj);
      
    }
   
    let realhour = Math.floor(seconds/ (munites * 60) );
  
    let secondsreal = seconds % 60;
    const minuetseee = Math.floor(seconds/(60*addonehours));

    var timmer = $(".timmer");
 timmer.html(realhour +  ':' +  minuetseee + ':' +secondsreal );
 seconds--;
    
  }
  });
 </script>

<script type="text/javascript"  >
    $(document).ready(function () {
        $("#chekbowdropdown").on('click', function(){
    $(".dropdownmenu").slideToggle(500);
        });
    });
  </script>

<script type="text/javascript">
window.onbeforeunload = function() {
 
  return "Are you sure you want to leave this page?";

}
 
 </script>


   <script src="loadNumberOfQuestionsnew.js"></script> 
   

   <script src="examPaperInfromation2.js"></script> 
   <script src="getStartButton_replace.js"></script> 
   <script src="startExam.js"></script> 
<script src="removepaper.js"></script>

<script src="updateAfterCreatedQuestion.js"></script>
<script src="deleteQuestions.js"></script>

 

</body>
</html>
