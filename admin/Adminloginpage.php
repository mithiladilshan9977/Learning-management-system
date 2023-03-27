<?php
include("dbconection.php");
$errormassage;
$sqlquery = "SELECT * FROM  deprtment WHERE status='0'";
$mysqliquery = mysqli_query($conn , $sqlquery);
if(isset($_POST['submit'])){
   
     $username = $_POST['username'];
     $firstname = $_POST['fistname'];
     $lastname = $_POST['lastname'];
     $password = $_POST['password'];
     $reenterpassword = $_POST['reenterpassword'];
     $emailaddress = $_POST['email'];
     $person = $_POST['persogn_signIn'];
     $thedepartment = $_POST['thedepartment'];
     
   

     $code = $_POST['code'];
 


         if($password !== $reenterpassword && $code != "fish"){
            echo '<div class="alert alert-danger" role="alert">
           Password and code incorrect
       </div>';
         }
      else if($password !== $reenterpassword){
         echo '<div class="alert alert-danger" role="alert">
          Passwords do not match
       </div>';
      }
      else if ($code !== "fish"){
        echo '<div class="alert alert-danger" role="alert">
         Incorrect code
       </div>';
      }

      else{
         
        $sql = "INSERT INTO adminn (departmentID,username , firstname , lastname,email, password ,person) VALUES('$thedepartment','$username' , '$firstname' , '$lastname' ,'$emailaddress', '$password' , '$person')";

        $mysqliquery = mysqli_query($conn , $sql);

        echo '<div class="alert alert-success" role="alert">
         Succesfully competed
      </div>';

      header("location:index.php");
        

      }
      

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("boostrapJquery.php"); ?>

    <link rel="shortcut icon" href="../images/camp.png" type="x-icon">
    <title>Admin sign in</title>
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
    }
    .maindiv{
        display: flex;
        width: 1300px;
        height: 800px;
        margin: 0px auto;
 

        justify-content: center;
        align-items: center;
    }
   
    .loginformdiv{
        width: 50vw;
        height: 100vh;
      
    }
    .adminimage{
     
        width: 500px;
        height: 600px;
        background-size: cover;
        position: relative;
         
    }
    .widthnew{
        width: 450px;
    }
    .container{
 
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        flex-direction: row;
    }
    .preloader{
        width: 100vw;
        height: 100vh;
        background-color: white;
        display: flex;
        position: absolute;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 100;
    }
    .preloader > img{
        width: 150px;
        height: 150px;
    }
    #preloader{
        width: 50px;
        height: 50px;
        margin-top: 15px;
    }
    #userpng{
        margin: 0px auto;
        margin-top: 15vh;
        position: relative;
        text-align: center;
        width: 100px;
        height: 100px;
    }
    .Gosigninpage{
        position: relative;
        float: right;
        top: 10px;
        right: 20px;
    }
    .lables{
        margin: 2px;
    }
    #showdeparmnetsnewwww{
        display:none;
    }
    #genpassword{
        display:inline-block;
  
        background-color: rgba(193, 193, 193, 0.693) ;
        cursor: pointer;
        padding:10px;
        border-radius: 50%;

    }
    #thepassowrd{
        display:inline-block;
        width:91%;
       

    }
    @media(max-width:770px){
        .imagediv{
            display: none;
        }
        body{
            background-image: url("../images/leon-wu-LLfRMRT-9AY-unsplash.jpg");
            background-size: cover;
            
        }
.form{
    background-color: rgba(255, 255, 255, 0.44);
    padding: 10px;
    border-radius: 10px;
}
    }
    </style>
</head>
<body>



<div class="preloader">
          <img src="../images/camp.png" alt="" class="rounded float-start">

          <img src="../images/preloader.gif" alt="" id="preloader">
    </div>



<div class="container">
<div class="imagediv">
    
            <img src="../images/leon-wu-LLfRMRT-9AY-unsplash.jpg" class="img-thumbnail adminimage" alt="...">

  


        </div>


<div class="form">
<center>
                <h3>Go - Xm Admin Registration</h3>
            </center>

            <form action="#" method="post">
         
            <div class=" ">
                <label for="" class="lables"><b>User name</b></label>
            <input class="form-control widthnew" type="text" placeholder="Admin User name *" aria-label="default input example" required name="username">
<br>
            <label for="" class="lables"><b>First name</b></label>
            <input class="form-control widthnew" type="text" placeholder="First name *" aria-label="default input example" required name="fistname">
<br>
            <label for="" class="lables"><b>Last name</b></label>
            <input class="form-control widthnew" type="text" placeholder="Last name *" aria-label="default input example" required name="lastname">
<br>
            <label for="" class="lables" style="display:block"><b>Password</b></label>

            <input class="form-control widthnew" type="text" placeholder="Password *" aria-label="default input example" required name="password" id="thepassowrd" onpaste="return false;" ondrop="return false">  <i class="fa-solid fa-unlock" onclick="getpassword()" id="genpassword"></i>            
<br>
            <label for="" class="lables mt-3"><b>Re-Enter password</b></label>
            <input class="form-control widthnew" type="text" placeholder="Re-Enter Password *" aria-label="default input example" required name="reenterpassword" onpaste="return false" ondrop="return false">
 <br>
            <label for="" class="lables"><b>Code</b></label>
            <input class="form-control widthnew" type="text" placeholder="Input Secret Code *" aria-label="default input example" required name="code" autocomplete="off">
            <br>
            <label for="" class="lables"><b>I am</b></label>

                        <select class="form-select widthnew" required name="persogn_signIn" id="personmainDiv"  >
                            <option selected>Select who are you</option>
                            <option value="admin">Admin</option> 
                            <option value="coordinator">Coordinator</option>
                           
                            </select>
                         <br>

                        

                         <div >
      
       <select class="form-select mb-2 " required  id="showdeparmnetsnewwww" name="thedepartment">
       <option selected>Select Department you incharge</option>
       <?php 
      

       while($rows = mysqli_fetch_assoc($mysqliquery))
       {
        ?>
                <option value="<?php echo $rows['depaermentID']?>"><?php echo $rows['departmentName']?></option> 
        <?php
       }
       
       ?>
        <input type="submit" value="Submit" class="btn btn-success mt-1 mb-2" name="submit"> <a href="index.php" class="btn btn-outline-primary  mt-1 mb-2">I have An Account</a>

 
                   
           
 
            
       



            </div>

            </form>
</div>


</div>
 <script>
    function getpassword(){
     
        var chars = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@#$%^&*()/{}[]";
        var passowrdLenght = 25;
        var password ="";
        for(var i =0 ; i <= passowrdLenght ;i ++){
            var randomNumber = Math.floor(Math.random() * chars.length);
            password +=  chars.substring(randomNumber ,randomNumber+1);
        }
    document.getElementById("thepassowrd").value=   password;
        
    }
    </script>
  

 <script type="text/javascript" src="Themainpreloader.js"></script>
  
 <script type="text/javascript" src="checktheperson.js"></script>
</body>
</html>