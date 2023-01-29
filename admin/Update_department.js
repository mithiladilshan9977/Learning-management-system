$(document).ready(function () {
    $("#updatebutton").on('click' , function(){
           var depaermentID = $("#depaermentID").val();
           var departmentName = $("#departmentName").val();
           var dean = $("#dean").val();

           var data = "depaermentID=" + depaermentID + "&departmentName=" + departmentName + "&dean=" + dean;

           $.ajax({
                             url:"update_ajax_department.php?",
                             method:"post",
                             data:data,

                             success:function(data){
                                $(".message").html(data);
                             }
           });

    });
});