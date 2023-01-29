$(document).ready(function () {
    $(".removepaper").click(function (e) { 
        e.preventDefault();
          
        var theexamid = $(".removebtn").val();
          var data = "theexamid=" + theexamid;
        
        $.ajax({
            type: "POST",  //默认get
            url: "removeExam.php",  //默认当前页
            data: data,  //格式{key:value}
          
            success: function (response) {  //请求成功回调
                $(".showtherrror").html(response);
            },
           
        })
    })
});