$(document).ready(function () {


    $("#savebtn").click(function (e) { 
        e.preventDefault();
     var studentIndex =  $("#studentPassIndex").val();
    var studentPassNew =  $("#studentPassNew").val();
    var studentRepeatPass =  $("#studentRepeatPass").val();

    var data = "studentIndex=" + studentIndex + "&studentPassNew=" + studentPassNew + "&studentRepeatPass=" + studentRepeatPass;

    $.ajax({
        type: "POST",  
        url: "updateStudentPass.php",   
        data: data,   
   
   
        success: function (response) {   
            $(".messagediv").html(response);
        },
        
       
    })
        
    })
    

 });