$(document).ready(function () {
    $("#changebtn").click(function (e) { 
        e.preventDefault();

        var newpass = $("#newpassword").val();
        var newpassAgain = $("#newAgainPass").val();

        var data  = "newpass=" +newpass + "&newpassAgain=" + newpassAgain; 

        $.ajax({
            type: "POST",  
            url: "updateNewPass.php",   
            data: data,  
          
            success: function (response) {  
                $(".alertdiv").html(response);
            },
            
        })
        
    })
});