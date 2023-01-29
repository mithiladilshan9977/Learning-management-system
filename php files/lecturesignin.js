$(document).ready(function () {
    $("#submit").on('click' , function(){
          
            var firstnmae = $("#firstnmae").val();
            var lastname = $("#lastname").val();
            var selectdepartment = $("#selectdeparmnt").val();
            var password = $("#password").val();
            var reenterpassword = $("#reenterpassword").val();
            var username = $("#username").val();

    
            var data =   "firstnmae=" + firstnmae + "&lastname=" + lastname + "&selectdepartment=" + selectdepartment + "&password=" + password + "&reenterpassword=" + reenterpassword + "&username=" + username;

            $.ajax({
                         url:"lecturer_athenticate.php?",
                         method:"post",
                         data:data,
                         success:function(data){
                            $(".showmessage").html(data);
                         }
            });

    });
});