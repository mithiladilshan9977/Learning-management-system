<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrapJquery.php"); ?>
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
     transform: translate(-10px,0px);
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
        <div class="item"><a href="adminhomepage.php"> <img src="../images/dashboard_8o5hanvh5tg7.svg" alt="" id="svgimages">DashBoard<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>
        <div class="item"><a href="adminusers.php"><img src="../images/admin_m8r7fgcpydjc.svg" alt="" id="svgimages">Admin Users<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>
        <div class="item"><a href="department.php"><img src="../images/company_ok4g4k31lwim.svg" alt="" id="svgimages">Department <img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>
        <div class="item"><a href="student.php"><img src="../images/student_rzs7f27z2hkg.svg" alt="" id="svgimages">Students<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>
         
        <div class="item"><a href="download.php"><img src="../images/download_7pyh4w5furkn.svg" alt="" id="svgimages">Downloadable Materials<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>
        <div class="item"><a href="adminlogs.php"><img src="../images/time_imn493hofx8t.svg" alt="" id="svgimages">Admin Logs<img src="../images/right_arrow_3nervmnj5u7h.svg" alt=""   id="arrow"></a></div>



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