$(document).ready(function () {
    var reciverID = $("#reciverID").val();

    var data = "reciverID=" + reciverID;
    setInterval(function(){
        $.ajax({
            type: "POST",  //默认get
            url: "checkimage.php",  //默认当前页
            data: data,  //格式{key:value}
           
            success: function (response) {  //请求成功回调
                $(".imagedMesaage").html(response);
            },
             
        })
    },1000);
});