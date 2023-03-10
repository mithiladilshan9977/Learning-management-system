$(document).ready(function () {
 
    $('input[type="radio"]').click(function(){
          var optionID = $(this).val();

          var questionNumber = $(this).closest(".optionsBox").find(".quesnumberValue").val();
          var spanTag = $(this).closest(".optionsBox").find(".responseshow");


          var data = "optionID_next=" + optionID + "&questionNumber_next=" + questionNumber;

          $.ajax({
            type: "POST",   
            url: "student_answer.php",  
            data: data,   
            
            success: function (response) {   
                spanTag.html(response);
            },
           
          })
          
    }) ;
     
    
    });