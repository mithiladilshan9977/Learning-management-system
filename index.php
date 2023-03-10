<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/camp.png" type="x-icon">
     <?php include("php files/boostrap.php")?>
    <title>Log in page</title>
    <style>
        *,*::after,*::before{
        padding: 0px;
        margin: 0px;
        box-sizing:  border-box;
    }
    :root{
        --bodybackgroundcolor: rgba(228, 228, 228, 0.444);
    }
    body{
        background-color: var(--bodybackgroundcolor);
        background-image: url("images/campus background.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }
    .login_box{
        width: 320px;
        height: 480px;
        border-radius: 10px;
        background-color: rgba(0, 0, 136, 0.736);
        color: white;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%,-50%);
        padding: 70px 30px;
       
    }
     .user{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        position: absolute;
        top: -50px;
        left: calc(50% - 50px);
     }
     .header{
        margin: 0;
        padding: 0 0 20px;
        text-align: center;
        font-size: 26px;
     }
     .para{
        margin: 0px;
        padding: 0;
        font-weight: bold;
    
     }
     .login_box input{
        width: 100%;
        margin-bottom: 20px;
        border: none;
        border-bottom: 1px solid white;
        background: transparent;
        outline: none;
        height: 40px;
        color: white;
        font-size: 16px;
     }
     #login{
        border: none;
        border-radius: 20px;
        background-color: blue;
        outline: none;
        height: 40px;
        color: white;
        width: 250px;
        display: block;
        cursor: pointer;
        transition: 0.2s all ease;

     }
     #login:hover{
          background: transparent;
          color: white;
          border: 2px solid white;
          transition: 0.2s all ease;
     }
     .anchortags{
        text-decoration: none;
        font-size: 12px;
        line-height: 20px;
        color: darkgrey;
     }
     .devider{
        position: absolute;
        width: 80%;
        background-color: white;
        height: 5px;
       
     }
     .anchortages{
        color: white;
        margin: 10px;
        text-align: center;
        text-decoration: none;
        position: relative;
     }
     .anchortages:hover{
       text-decoration: underline;
       color: white;
     }
     .campusname{
      position: absolute;
      left: 30px;
      top:120px;
      color: rgba(255, 255, 255, 0.712);
      font-size: 75px;
      display: inline-block;
     }
     .welcomebanner{
      position: absolute;
      left: 30px;
      display: block;
      top:220px;
      color:  gray;
      font-size: 35px;
     }
   .mainhigt{
      display: flex;
      width: 100vw;
      justify-content: center;
      align-items: center;
      position: fixed;
      bottom: 0px;
      background-color: white;
   }
   .mainhigt>p{
      color: black;
   }
   .myprofile{
      color: blue;
      text-decoration: none;
      cursor: pointer;
   }
   .myprofile:hover{
      text-decoration: underline;
   }
   .lec{
      margin-left: 25px;
   }
.aboutus{
   position: absolute;
   float: right;
   top: 10px;
   right: 20px;
}
.inputBoxses{
   padding-left: 7px;
}
.aboutus > a{
   text-decoration: none;
   color: aliceblue;
}
   @media  (max-width : 545px){
      .welcomebanner{
         display: none;
      }
   }
    </style>
</head>
<body>
 <?php include("php files/preloader.php");?>
 <div class="aboutus">
 <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdropnew">About Us</a>
 </div>



 <div class="modal fade"   id="staticBackdropnew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content" style="width: 600px;">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">About Us</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Saegis Campus is a vibrant, state of the art campus, acclaimed for excellence with industrialists passionately seeking Saegis graduates. The aim of Saegis Campus is to bring forth the latest breed of leaders and intellectuals who possess the right mixture of strategic sense and inherent understanding of how their thinking, skills and talents could be applied in achieving their aspirations. By promoting a perception of innovative judgement and open communication, Saegis Campus inspires students and staff to establish and generate a definite change.</p>

      <p>Saegis Campus, a member of Sakya Group, assures you of an unparalleled tertiary education experience that is geared to meet the next generation graduate requirements of Sri Lanka and the Globe. Located in a picturesque and scenic block of land with easy access to the capital city, Saegis Campus is equipped with all the modern facilities a campus should have from the latest teaching/learning technological appliances to comfortable and air conditioned lecture theatres, IT laboratories and auditoriums.</p>

      <p>With an excellent staff of well experienced and much respected lecturers and professors as resource persons; efficient non academic staff, the management of Saegis Campus strives to deliver qualitative tertiary education on par with the international standards.

Saegis Campus is an unmatched investment for those who seek to pursue truly a life enhancing experience.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>




  <h2 class="campusname" >Saegis Campus</h2>

  <p class="welcomebanner"> <span class="auto-typeing"></span></p>

<div class="showmessagenew">

</div>
     <div class="login_box">
    
        <img src="images/user_d0g6rdiolj89.svg" alt="" class="user">
        <h1 class="header">Go-Xm Log in</h1>
       
       
      
            <p class="para">User name</p>
            <input type="text" placeholder="User name" id="username" class="inputBoxses">

            <p class="para">Password</p>
            <input type="text" placeholder="Password" id="password" class="inputBoxses">

            <button type=" "   id="login">Log in</button>
      
                 
          

       
<br>
        <span class="devider">  </span>
         <br>
         <center><h2>Sign In</h2></center>
         <br>
       <a href="php files/student_signin.php" class="anchortages">I'm a Student</a>
       <a href="php files/lecture_signin.php" class="anchortages lec">I'm a Lecturer</a>


     </div>
 
 <div class="mainhigt">
 <p class="indexfotter" > Saegis Campus Copyright &copy; All rights reserved | Developed and maintain by <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="myprofile">MITHILA DILSHAN</a> ( <a href="https://www.linkedin.com/in/mithila-dilshan-473905228/" class="myprofile" target="_blank">LinkedIn</a> ) -BIT 2</p>

 
 </div>
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Developer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <img src="images/studentimage.jpg" alt=""  class="img-thumbnail">

       
       <center>
        <label for=""><b>Name</b></label>
        <p>Mithila dilshan</p>
      
        <label for=""><b>E-mail</b></label>
        <p>dilshanwickramaarachchi@gmail.com</p>
   
        <label for=""><b>Batch</b></label>
        <p>BIT -2 </p>
       </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

 
 
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
 var typed = new Typed(".auto-typeing" , {
   strings : ['Welcome to Go -Xm LMS' , 'Best Learning Management Platform', 'Manage your all works easyly'],
   typeSpeed:150,
   backSpeed:50,
   loop: true
 })
</script>
   <script type="text/javascript" src="php files/authenticateuser.js"></script>  
</body>
</html>