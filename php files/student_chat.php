<?php 
 include("databaseconn.php");
 session_start();
// require("sessionTime.php");
if(!isset($_SESSION['studentID'] )){
  header("location:../index.php");
}

$studentid = $_GET['studentID'];
$firstName = $_GET['firstName'];
$lstName = $_GET['lastName'];
$imagePath = $_GET['imagepath'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Student Chat</title>
    <link rel="shortcut icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/brands.min.css" type="x-icon">
    <?php include("boostrap.php"); ?>
</head>
<style>
   .container{
      max-width: 500 !important;
      margin: auto;
      margin-top: 6%;
      font-family: sans-serif;
      letter-spacing: 0.5px;
      
   }
   .img{
       width: 40px;
       height: 40px;
 
      border-radius: 50%;
      
   }
   .msg-header{
      border: 1px solid #ccc;
      width: 100%;
      height: 10%;
      border-bottom: none;
      display: inline-block;
      background-color: #007bff;
   }
   .msg-header-img{
 
      border-radius: 50%;
      width: 20px;
     
      margin-left: 5%;
      margin-top: 8px;
      float: left;
   }
   .active{
      width: 500px;
      float: left;
  
      margin-top: 10px;
      margin-left: 28px;
   }
   .active h4{
      font-size: 20px;
      margin-left: 10px;
      width: 80%;
    
 color: ;
      color: #fff;
   }
   .active h6{
      font-size: 10px;
      margin-left: 10px;
 
      line-height: 2px;
      width: 80%;
 
      color: #fff;

   }
   .header-icons{
      width: 120px;
      float: right;
      margin-top: 12px;
      margin-right: 10px;
   }
   .chat-page{
      padding: 0 0 50px 0;
   }
   .msg-inbox{
      border: 1px solid #ccc;
      overflow: hidden;
      padding-bottom: 30px;
   }
   .chats{
      padding: 30px 15px 0 25px;
   }
   .msg-page{
      height: 516px;
      overflow-y: auto;
     
   }
   .recevied-chats-img{
      display: inline-block;
      width: 20px;
      float: left;
   }
   .received-msg{
      display: inline-block;
      padding: 0 0 0 10px;
       margin-left: 20px;
      vertical-align: top;
      width: 92%;
   }
   .recevied-msg-inbox{
   width: 57%;

   }
   .recevied-msg-inbox p {
      background: #efefef none repeat-x scroll 0 0 ;
     border-radius: 20px 20px 20px 0px;
      color: #646464;
      font-size: 15px;
      margin: 0;
     padding: 18px;
      width: 100%;
   }
   .time{
      color: #777;
      display: block;
      font-size: 12px;
      margin:8px 0 0  ;

   }
   .outgoing-chats{
      overflow: hidden;
      margin: 5px 20px;
   }
   .outgoing-chats-msg p {
      background: #007bff none repeat scroll 0 0 ;
      color: #fff;
      border-radius: 20px 20px 0px 20px;
      font-size: 15px;
      margin: 0;
      color: #fff;
      padding: 18px;
      width: 100%;

   }
   .outgoing-chats-msg{
       float: left;
       width: 46%;
       margin-left: 45%;
   }
   .outgoing-chats-img{
      display: inline-block ;
      width: 20px;
      margin-right: 70px;
      float: right;
   }
    
.onlineicon{
   position: relative;
   top:-20px;
   
   left:16px;
}
  
</style>
<body>
 

<?php include("student_header.php")  ?>
 
 
<div class="container " style="position: relative;" >


    <div class="msg-header"  >
   <a href="student_chat_list.php"> <img src="../images/back_arrow_oktlbpm41bwk (1).svg" alt="" style="width: 20px; height: 20px; position: absolute; left: 25px; top: 16px;"></a>
      <div class="msg-header-img">
         <img class="img-thubnail img" src="<?php echo $imagePath?>" alt=""><span class="onlineicon"> </span>
         <input type="hidden" value="<?php echo $studentid?>" id="reciverID">
      </div>
      <div class="active"></h6>
         <h4><?php echo $firstName.' '.$lstName ?></h4>
         <h6 class="activenone">Go -Xm chating platform</h6>   
      </div>
     
    </div>

    <div class="chat-page" >
  
      <div class="msg-inbox">
         <div class="chats">

            <div class="msg-page">
            <span class="imagedMesaage"></span>
                      <div class="sedingMesaage"></div>
                           <!-- <div class="received-chats"> 
                              <div class="recevied-chats-img">
                                 <img  class="img-thubnail img" src="profileimage/2022.12.22-03.52.01pm.jpg" alt="">
                              </div>

                              <div class="received-msg">
                              <div class="recevied-msg-inbox">
                                 <p>Hi - how are you</p>
                                 <span class="time">11:00 PM </span>
                              </div>
                              </div>
                        </div> -->


    <div class="reviceddMesaage"></div>

            <!-- <div class="outgoing-chats"> 
                  

                  <div class="outgoing-chats-msg">
                    <div class="outgoing-msg-inbox">
                     <p>Hi - how are you</p>
                     <span class="time">11:00 PM </span>
                    </div>
                  </div>
                  <div class="outgoing-chats-img">
                     <img class="img-thubnail img" src="profileimage/2022.12.22-03.52.01pm.jpg" alt="">
                  </div>
            </div> -->




            </div>
         </div>
 



      <div class="mas-bottom" style="background-color: #007bff; padding: 10px;">
          
   
              <input type="text" class="form-control bottonInput my-1" placeholder="Send message to :<?php echo $firstName.''.$lstName ?>" style="  display: inline-block; width: 92%;" id="messgaeText">
 
               
                  <span class="" style=" margin: 10px; cursor: pointer; background-color: white; width: 280px; height: 280px; border-radius: 50%; padding: 15px;" id="sendingbtn"><i class="fa fa-paper-plane" style=""></i></span>
                
       
      </div>

      </div>
    </div>
</div>
</body>
 <script src="senfingmessge.js"></script> 
<script src="fetchingMessges.js"></script>
<script src="gerRecivedmessge.js"></script>
<script src="checkingOnline.js"></script>
<script src="checkiamge.js"></script>
 
</html>