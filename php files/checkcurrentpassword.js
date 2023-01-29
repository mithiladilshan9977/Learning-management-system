$(document).ready(function () {
     $("#currentpassword").keyup(function (e) { 
         var thecurrentPass = $(this).val();
          var data = "thecurrentPass=" + thecurrentPass;
         $.ajax({
            
            url: "checkCurrePass.php",   
            method:"post",
            data:data,
            dataType: "html",
            beforeSend: function(){
            
              
            },
            
            success: function (response) {   
                $(".errorshow").html(response);
            },
            
         })
     });


 
});