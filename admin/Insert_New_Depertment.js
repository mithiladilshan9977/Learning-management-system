$(document).ready(function () {

    $("#okbtn").on('click' , function(){
        var Department = $("#Department").val();
        var PersoneIncgarge = $("#PersoneIncgarge").val();
        var data  = "Department=" + Department + "&PersoneIncgarge=" + PersoneIncgarge;
    
        $.ajax({
                    url:"insert_Derment.php?",
                    method:"post",
                    data:data,
    
                    success:function(data){
                      $(".showlaertmssage").html(data);  
                    }
        });
    });
    


});