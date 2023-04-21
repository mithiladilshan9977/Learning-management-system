$(document).ready(function () {
    $(".chechAvaibelExam").click(function (e) { 
        e.preventDefault();
 
 var thevalue = $(this).closest(".container").find(".inputvalue").val();
 var startpasword = $(this).closest(".container").find(".startpassword").val();

 
     var data = "examID=" + thevalue +"&startpassword="+startpasword;
 
       $.ajax({
        type: "POST",  //默认get
        url: "checkavailabel.php",  //默认当前页
        data: data,  //格式{key:value}
       
       
        success: function (response) {  //请求成功回调
           $(".showthealert").html(response) ;
        },
        
       })  
        
    })
});