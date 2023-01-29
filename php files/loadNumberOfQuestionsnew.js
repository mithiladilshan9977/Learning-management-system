$(document).ready(function () {
 
    $("#getNumnerOFforms").click(function (e) { 
        e.preventDefault();

        var thenumberOfquestion = $("#numberofuqestion").val();

        var data = "thenumberOfquestion=" + thenumberOfquestion;

 
        $.ajax({
            type: "POST",  //默认get
            url: "getQUestionTempl.php",  //默认当前页
            data: data,  //格式{key:value}
          
            success: function (response) {  //请求成功回调
                $(".questionTemplteLoad").html(response);
            },
             
        })
        
    })
});