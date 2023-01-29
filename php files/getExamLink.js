$(document).ready(function () {
    


    setInterval(function(){
        $.ajax({
        
            url: "getExamLink.php",  //默认当前页
           
            dataType: "html",
         
            success: function (response) {  //请求成功回调
                $(".addLink").html(response);
            },
             
        })
    } , 1000);
    
});