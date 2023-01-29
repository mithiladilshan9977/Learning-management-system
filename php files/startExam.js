$(document).ready(function () {
    $("#startExamBTtn").click(function (e) { 
        e.preventDefault();

        $.ajax({
            type: "POST",  //默认get
            url: "startTheExam.php",  //默认当前页
          
            dataType: "html",
            
            success: function (response) {  //请求成功回调
                $(".showthemessage").html(response);
            },
            
        })
        
    })
});