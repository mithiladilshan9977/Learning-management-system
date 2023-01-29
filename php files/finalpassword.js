$(document).ready(function () {
 
    $("#okbtn").click(function (e) { 
        e.preventDefault();

        var thepassword = $("#passwordinput").val();
 
        var data = "thepassword=" + thepassword;

        $.ajax({
            type: "POST",  //默认get
            url: "finalpassword.php",  //默认当前页
            data: data,  //格式{key:value}
           
           
            success: function (response) {  //请求成功回调
                $(".showmessage").html(response);
            },
            
        })
        
    })
});