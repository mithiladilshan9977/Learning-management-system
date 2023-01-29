$(document).ready(function () {
    $("#currentpassword").keyup(function (e) { 
      
         var currentPass  = $(this).val();
    

         var data = "currentPass=" + currentPass;

         $.ajax({
            type: "POST", 
            url: "lecCurrentPass.php",  
            data: data,  
         
          
            success: function (response) {   
                $(".showthemessage").html(response);
            },
             
         })
    });

    $("#newpPassAgain").keyup(function (e) { 
         var newpPassAgain = $(this).val();
         var newPass = $("#newPass").val();
     


         var newdata = "newpPassAgain=" +newpPassAgain + "&newPass=" + newPass;

         $.ajax({
            type: "POST",   
            url: "checkNewPass.php",  
            data: newdata,   
         
            success: function (response) {   
                $(".showthemessagenew").html(response);
            },
            
         })
    });




});