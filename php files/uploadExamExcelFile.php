<?php 
include("databaseconn.php");
session_start();
error_reporting(0);
// require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}
else{
    $lecID = $_SESSION['lectureID'];
    $examPaperID = $_SESSION['EXAM_PAPER_ID'];
    $batchID = $_SESSION['batchID_new'];



}
$output = '';
if(isset($_POST["export_excel"])){
    echo "dwadwd";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("boostrap.php")?>
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    
    <title>Upload Excel</title>
</head>
<style>
    .mainHolder{
        
        position: relative;
        margin-top: 25px;
        padding: 10px;
    }
    .stepTitle{
        background-color: rgba(0, 232, 249, 0.252);
        border-radius:15px;
        padding: 15px;
        font-size: 20px
    }
    .guideline{
        margin: 2px 0px 2px 10px;
        font-size: 17px
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
</style>
<body>
 
<?php include("innerpreloader.php");?>
<?php include("lecturer_header.php")  ?>

<?php include("my_students_nav.php")  ?>


<div class="container mainHolder" style="width:70%">
<h5 class="maintitleMain">Follow below guideline to upload</h5>
<p class="stepTitle">Step 1</p>
<center>
<img src="../images/examInfo.png" class="img-thumbnail examinforimage" alt="..."> </center>
 
<p class="guideline">  <img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put time hours in <b>A1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put time minutes in <b>B1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put password in <b>C1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Put subject name in <b>D1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/> Import excel file by pressing <b>'Import Excel'</b> button & upload</p>


<!-- // upload the exam info -->
<form action="uploadExamExcelFile.php" method="post" enctype="multipart/form-data" id="examInforForm">
    
   
          <input type = "file"   id="excelfile" accept=".xlsx"  name="excel" required>
         <label for="excelfile" class="btn btn-primary"  >Import Excel</label>
         <input type="submit" value="Upload" class="btn btn-success" name="uploadExcel" required>
   
 </form>




<form action="uploadExamExcelFile.php" method="post">
<input type="submit" value="Download" class="btn btn-success" name="export_excel"  >

</form>


 <!-- /// add questions -->

<p class="stepTitle">Step 2</p>
<center>
<img src="../images/examQuestions.png" class="img-thumbnail examinforimage" alt="..."> </center>
 
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Exam paper ID appears automatically in <b>A1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Put question number in <b>B1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Write the question in <b>C1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Import excel quetion file by pressing <b>'Import Excel Question'</b> button & upload</p>

<form action="uploadExamExcelFile.php" method="post" enctype="multipart/form-data" id="examInforForm">
       <input type = "file"   id="excelfile_question"  accept=".xlsx" name="excel_question" required>
         <label for="excelfile_question" class="btn btn-primary"  >Import Excel Question</label>
         <input type="submit" value="Upload question" class="btn btn-success" name="uploadExcel_question" required>
   
 </form>




 <p class="stepTitle">Step 3</p>
<center>
<img src="../images/questionOptions.png" class="img-thumbnail examinforimage" alt="..."> </center>
 
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Exam paper ID appears automatically in <b>A1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Put question number in <b>B1 cell</b>(there are 5 options for 1 question)</p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Write the options in <b>C1 cell</b></p>
<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Put 1 for correct answer and 0 for rest <b>D1 cell</b></p>

<p class="guideline"><img src="../images/guidLineCheck.png" style="width:20px ; height:20px; margin-right:10px"/>Import excel quetion file by pressing <b>'Import Excel options'</b> button & upload</p>




<!-- add oprions -->
<form action="uploadExamExcelFile.php" method="post" enctype="multipart/form-data" id="examInforForm">
        
 <input type = "file"   id="excelfile_question_options"  accept=".xlsx" name="excel_question_options" required>
<label for="excelfile_question_options" class="btn btn-primary"  >Import Excel options</label>
<input type="submit" value="Upload options" class="btn btn-success" name="uploadExcel_question_options" required>

</form>


</div>





 


 







</body>
</html>