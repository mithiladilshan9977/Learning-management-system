$(document).ready(function () {
 
    var theExamId = $("#currentexamid").val();
     
    var data = "theExamIdnew=" +theExamId;
   
    setInterval(function(){
    $.ajax({
        type: "POST",   
        url: "getMisteksFromCurrentExam.php",  
        data: data,   
        dataType: "html",
       
        success: function (response) {   
             $("#showtheresult").html(response);
        },
        
    })
} , 1000);
});  