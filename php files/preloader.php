<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

.preloader{
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.356);
        display: flex;
        z-index: 500;
        position: absolute;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .preloader > img{
        width: 150px;
        height: 150px;
        z-index: 501;
    }
    #preloader{
        width: 50px;
        height: 50px;
        z-index: 501;
        margin-top: 15px;
    }
</style>
</head>
<body>
<div class="preloader">
          <img src="images/camp.png" alt="" class="rounded float-start">

          <img src="images/Pulse-1s-200px.gif" alt="" id="preloader">
    </div>




    <script type="text/javascript" >

$(window).on('load' , function(){
        
        $(".preloader").fadeOut(500);
    
    });
    </script>
</body>
</html>