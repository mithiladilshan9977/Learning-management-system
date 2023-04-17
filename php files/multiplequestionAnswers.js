$(document).ready(function () {

    $('input[type="checkbox"]').click(function(){
        if(!$(this).is(':checked')) {
   
  
            var optionID_unckeced = $(this).val();

            var questionNumber_unckeced = $(this).closest(".optionsBox").find(".quesnumberValue").val();
            var spanTag_unckeced = $(this).closest(".optionsBox").find(".mulitiplqquestion");

        var data = "optionID_unckeched_next=" + optionID_unckeced + "&questionNumber_unckeched_next=" + questionNumber_unckeced;

        $.ajax({
            type: "POST",   
            url: "UncheckMultipleQuestion.php",  
            data: data,   
            
            success: function (response) {   
                spanTag_unckeced.html(response);
            },
           
          })



        } else{
            var optionID = $(this).val();

            var questionNumber = $(this).closest(".optionsBox").find(".quesnumberValue").val();
            var spanTag = $(this).closest(".optionsBox").find(".responseshow");
    
      
            var data = "optionID_next=" + optionID + "&questionNumber_next=" + questionNumber;
    
            $.ajax({
              type: "POST",   
              url: "checkMultipleQuestion.php",  
              data: data,   
              
              success: function (response) {   
                  spanTag.html(response);
              },
             
            })
        }
    

     
        
  }) ;
});