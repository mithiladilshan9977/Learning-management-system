 

$(document).ready(function () {

    $(".updateimage").click(function (e) { 
        e.preventDefault();
 
         $(this).closest(".notediv").find('.updatemaindiv').slideToggle(100);
 





    //     var updateText = $(".notemessagenew").val();

    //    var theval = $(this).closest("#exampleModalapple").find(".newupdatebtn").val();
    //     var data = "updateText=" +updateText;
      
    //     alert(theval);
    //     $.ajax({
    //         type: "POST",  //默认get
    //         url: "insertUpdateNote.php",  //默认当前页
    //         data: data,  //格式{key:value}
         
    //         success: function (response) {  //请求成功回调
    //             $(".applemessage").html(response);
    //         },
            
    //     })
        
    })
});