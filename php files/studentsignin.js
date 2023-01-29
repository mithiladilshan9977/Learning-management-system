$(document).ready(function () {



    $("#submit").on('click' , function(){
            var indexnumber = $("#indexnumber").val();
            var firstnmae = $("#firstnmae").val();
            var lastname = $("#lastname").val();
            var selectbatch = $("#selectbatch").val();
            var password = $("#password").val();
            var reenterpassword = $("#reenterpassword").val();
    
            var data = "indexnumber=" + indexnumber + "&firstnmae=" + firstnmae + "&lastname=" + lastname + "&selectbatch=" + selectbatch + "&password=" + password + "&reenterpassword=" + reenterpassword;

            $.ajax({
                         url:"student_athenticate.php?",
                         method:"post",
                         data:data,
                         success:function(data){
                            $(".showmessage").html(data);
                         }
            });

    });
});