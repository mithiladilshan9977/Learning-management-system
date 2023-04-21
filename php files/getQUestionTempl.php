<?php

include("databaseconn.php");
session_start();
// require("lectetrSESSION.php");

if(!isset($_SESSION['lectureID'])){
  header("location:../index.php");
  die();
  
}
$startNumber = 1;
$thenumberOfquestion = $_POST['thenumberOfquestion'];

while($startNumber <=$thenumberOfquestion) {
    
    ?>
  
<center> <h3 class="my-3">Add New Question</h3> </center>
 

 <div class="container singelAnwerquestion"  style="width: 700px; display: flex; flex-direction: column; align-items: center; justify-content: center;">

 <label for=""><b>Question Number</b></label>

 <input type="number" name=""   class="form-control my-3 questionumber" style="width: 100px;" max="50" min="1" value="<?php echo $startNumber?>">

 <label for="" class="my-1"><b>What is the question ? </b></label>
 <textarea name="" id="" cols="5" rows="5" class="form-control whatisQuestion" placeholder="Write the question here" style="color:  black; font-weight: bold;"></textarea>


 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 1 : </b></p>
    <input type="text" class="form-control my-1 choice1" placeholder="Option for Choice 1">

 </div>

 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 2 : </b></p>
    <input type="text" class="form-control my-1 choice2" placeholder="Option for Choice 2">

 </div>

 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 3 :</b> </p>
    <input type="text" class="form-control my-1 choice3" placeholder="Option for Choice 3">

 </div>

 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 4 :</b> </p>
    <input type="text" class="form-control my-1 choice4" placeholder="Option for Choice 4">

 </div>

 <div class="questionBox" style=" width: 550px;">
    <p class="mt-1"><b>Choice 5 : </b></p>
    <input type="text" class="form-control my-1 choice5" placeholder="Option for Choice 5 (if there)">

 </div>
 <div class="shwoemsshe"> </div>

 <label for=""><b>Correct Choice Number</b></label>
 <input type="number" name="" id="" class="form-control mt-2 correctNumber" style="width: 100px;" min="1" max="5">

 <input type="submit" class="btn btn-success my-3 submitPaperbtn   " value="Add This Question"  >
 <small style="color: red; opacity: 0.8;">Add question from beginning</small>
 
 <select class="form-select mulipleSelectDropdown mt-2" aria-label="Default select example">
  <option selected class="removetext">Remove</option>
  <option value="multiple">Add multiple question</option>
 
</select>
<div class="container innerdiv">
   
</div>
</div>









<hr>

<?php
        $startNumber++;
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
     .removetext{
      color:red;
     }
</style>
<body>
    


<script src="insertingQestions.js"></script>
<script src="LoadMultipleQuestion_new.js"></script>

</body>
</html>


