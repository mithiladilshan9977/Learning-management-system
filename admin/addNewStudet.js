$(document).ready(function () {

    $("#okbutton").on('click', function(){
         var selectstudentbatch=  $("#selectstudentbatch").val();
         var indexnumber=  $("#indexnumber").val();
         var studentFName=  $("#studentFName").val();
         var StudentLname=  $("#StudentLname").val();
 
         var data = "selectstudentbatch=" + selectstudentbatch + "&indexnumber=" + indexnumber + "&studentFName=" + studentFName +"&StudentLname=" + StudentLname;

         $.ajax({
                 url:"add_new_student.php?",
                 method:"post",
                 data:data,

                 success:function(data){
                    $(".showerrormessage").html(data);
                 }

         });


    });
});