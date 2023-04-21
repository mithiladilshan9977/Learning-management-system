<?php
include("databaseconn.php");
session_start();
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
  $mutipleText = $_POST['valueSelected_next'];
if($mutipleText  == 'multiple')
{?>

<div class="container mainouterdiv">
<center><label for=""><b>Question Number</b></label>

 <input type="number" name=""   class="form-control my-3 questionumber" style="width: 100px;" max="50" min="1" value="<?php echo $startNumber?>">
 </center>
 <label for="" class="my-1"><b>What is the question ? </b></label> 
 
 <textarea name="" id="" cols="5" rows="5" class="form-control whatisQuestion" placeholder="Write the question here" style="color:  black; font-weight: bold;"></textarea>


 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 1 : </b></p>
    <input type="checkbox" class="myCheckbox" name="myCheckbox" value="1">
    <input type="text" class="form-control my-1 choice1 inpuetanswerbox" placeholder="Mutiple Option for Choice 1">

 </div>

 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 2 : </b></p>
    <input type="checkbox" class="myCheckbox" name="myCheckbox" value="1">

    <input type="text" class="form-control my-1 choice2 inpuetanswerbox" placeholder="Mutiple Option for Choice 2">

 </div>

 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 3 :</b> </p>
    <input type="checkbox" class="myCheckbox" name="myCheckbox" value="1">

    <input type="text" class="form-control my-1 choice3 inpuetanswerbox" placeholder="Mutiple Option for Choice 3">

 </div>

 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 4 :</b> </p>
    <input type="checkbox" class="myCheckbox" name="myCheckbox" value="1">

    <input type="text" class="form-control my-1 choice4 inpuetanswerbox" placeholder="Mutiple Option for Choice 4">

 </div>

 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 5 : </b></p>
    <input type="checkbox" class="myCheckbox" name="myCheckbox" value="1">

    <input type="text" class="form-control my-1 choice5 inpuetanswerbox" placeholder="Mutiple Option for Choice 5 (if there)">

 </div>
 <div class="shwoemsshe"> </div>
 
<center>
 <input type="submit" class="btn btn-success my-1 submitPaperbtnMultiple" value="Add This Question"  ></center>
 
 <center>
 <small style="color: red; opacity: 0.8;">Add question from beginning</small></center>

</div>
<?php
 

}else{
    echo " " ;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
     .submitPaperbtncclicked{
      background-color: transparent;
      border: 2px solid rgba(189, 0, 0, 0.825);
      color: rgba(189, 0, 0, 0.825);
     }
     .mulipleSelectDropdown{
      width: 50%;
     }
     .mainouterdiv{
      background-color: rgba(45, 45, 255, 0.075);
      padding: 15px;
      border-radius: 15px;
      margin-top: 10px;
     }
     .myCheckbox{
      cursor: pointer;
     }
     
</style>
<body>
    


 
<script src="getrightansersMultiple_re.js"></script>

</body>
</html>


