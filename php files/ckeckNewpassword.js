$(document).ready(function () {
    $("#newAgainPass").keyup(function (e) { 
         var newPassAgain = $(this).val();
         var newPass = $("#newpassword").val();
         

         var data = "newPassAgain=" + newPassAgain + "&newPass=" + newPass;

         $.ajax({
            type: "POST",   
            url: "checkingnewPass.php",   
            data: data,  
            dataType: "html",
       
            success: function (response) {  
                $(".errorshowagain").html(response);
            },
          
         })
    });
});