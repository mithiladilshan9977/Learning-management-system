<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrap.php"); ?>
    <title>Document</title>
    <style>
         
   .side_bar{
    background-color: rgba(0, 30, 255 , 0.5004);
    backdrop-filter: blur(2px);
    box-shadow: 5px 5px 10px rgba(0, 30, 255 , 0.5004) ;
    width: 291px;
    height: 100vh;
    position: fixed;
    top: 0px;
    left: -100%;
    z-index: 100;
    transition: 0.6s ease;
    transition-property: left;
   }
   .side_bar .menu{
     width: 100%;
     margin-top: 80px;
   }
   .side_bar .menu .item{
    position: relative;
    cursor: pointer;
   }
   .side_bar .menu .item a{
    color: blanchedalmond;
    
    font-size: 16px;
    text-decoration: none;
    display: block;
    padding: 5px 30px;
    line-height: 60px;
   }
   .side_bar .menu .item a:hover{
    background: rgba(0, 30, 255 , 0.6004);
    transition: 0.3s ease;
   }
   .side_bar .menu .item i {
    margin-right: 15px;
   }
   .close_buutton{
    position: absolute;
    color: black;
 
    right: 0px;
    margin: 25px;
    cursor: pointer;
    background-color: rgba(255, 255, 255, 0.608);
    padding: 10px;
    border-radius: 50%;
    transition: 0.2s all ease;
   }
   .close_buutton:hover{
    background-color: rgba(255, 255, 255, 0.708);
   }
   .memu_btn{
    position: absolute;
    color: black;
    font-size: 20px;
    margin: 25px;
    cursor: pointer;
   }
   .active{
        left: 0px;
   }
   .close_buutton img{
    width: 25px;
    height: 25px;
    transition: 0.2s all ease;

   }
   .close_buutton img:hover{
    transform: rotate(90deg);
   }
   #svgimages{
   width: 32px;
   height: 32px;
   transition: 0.2s all ease-in-out;
   margin-right: 21px;
   }
   .side_bar .menu .item:hover #svgimages{
      transform: scale(1.2,1.2);
     transition: 0.2s all ease-in-out;
   }
   #arrow{
    position: absolute;
    right: 10px;
    width: 11px;
    top: 30px;
    height: 11px;
    margin-left: 99px;
}
    </style>
</head>
<body>
    

<div class="memu_btn">
<img src="../images/menu_vpnpy0k6arb0.svg" alt="" id="svgimages">  
</div>
<div class="side_bar">
    <div class="close_buutton">
       <img src="../images/cancel.png" alt=""> 
    </div>
    <div class="menu">
        <div class="item"><a href="student_class.php"> <img src="../images/class_l27qjkla7zex.svg" alt="" id="svgimages">MY Class<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>
        <div class="item"><a href="student_notifications.php"> <img src="../images/notification_0nch4sgyde3a.svg" alt="" id="svgimages">Notifications<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>

        <!-- <div class="item"><a href="student_chat.php"> <img src="../images/chat_bp1hacf5p80y.svg" alt="" id="svgimages">Start Chat<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div> -->

        <div class="item"><a href="student_exam.php"> <img src="../images/exam_fvffy62do17t.svg" alt="" id="svgimages">Exams<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>

        <div class="item"><a href="student_chat_list.php"> <img src="../images/chat_bp1hacf5p80y.svg" alt="" id="svgimages">Start Chat<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>


 
    
       



    </div>
</div>

















<!-- 


<div class="container">
    <ul>
        <li><a href="adminhomepage.php">DashBoard</a></li>

        <li><a href="subjects.php">Subject</a></li>

        <li><a href="batch.php">Batch</a></li>

        <li><a href="adminusers.php">Admin users</a></li>

        <li><a href="department.php">Department</a></li>

        <li><a href="student.php">Students</a></li>

        <li><a href="lectures.php">Leactures</a></li>

        <li><a href="">Downloadable Materials</a></li>

        <li><a href="adminlogs.php">Admin Log</a></li>

    </ul>
</div> -->

</body>
<script type="text/javascript">
$(document).ready(function () {
 
    $(".memu_btn").on('click', function(){
        $(".side_bar").addClass('active');
        $('.memu_btn').css("visibility" , "hidden");
    });
    $(".close_buutton").on('click', function(){
        $(".side_bar").removeClass('active');
        $('.memu_btn').css("visibility" , "visible");

    });
});

</script>
</html>