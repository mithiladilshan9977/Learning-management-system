$(document).ready(function () {
     
    setInterval(() => {
        
 
    $.ajax({
        
        url: "getStartButton.php",   
        
        dataType: "html",
        beforeSend: function () {},  
        success: function (response) {  //请求成功回调
           $(".startBtton").html(response); 
        },
         
    })
}, 1000);
});