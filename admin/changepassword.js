$(document).ready(function () {
    $("#newpasswordAgain").keyup(function (e) { 
         var theAgainPass = $(this).val();
         var newPass = $("#newpassword").val();

        var data = "newPass=" + newPass + "&theAgainPass=" + theAgainPass;

        $.ajax({
            type: "POST",  
            url: "LecChangePass.php",  
            data: data,   
           
            beforeSend: function () {
                $(".preloaderr").show();  
            },  
            success: function (response) {  
                $(".showthemessage").html(response);
            },
             
            complete: function () {
                $(".preloaderr").hide();  
            },  
        })
          
    });
});