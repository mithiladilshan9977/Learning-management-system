$(document).ready(function () {
      
    $(".reply_btn").click(function (e) { 
        e.preventDefault();
        var theStudentID = $(this).closest(".boxdiv").find(".reply_btn").val();
          var data = "theStudentID=" + theStudentID ;
      $.ajax({
         url:"addorremove.php?",
         method:"POST" , 
         data:data,

         success:function(data){
$(".showthemessage").html( data + "");
         }
      });
      



    })
 
});
