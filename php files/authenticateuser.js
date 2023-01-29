$(document).ready(function () {
    $("#login").on('click' , function(){

       
      
        var username = $("#username").val();
        var password = $("#password").val();
        
        var data = "usernamenew=" + username + "&passwordnew=" + password;
      

        $.ajax({

              url:"php files/new_authenticatelogin.php?",
              method:"post",
              data:data,
              success:function(data){
                $(".showmessagenew").html(data);
              }

        });

        
        

    });

});