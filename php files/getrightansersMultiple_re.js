$(document).ready(function () {
 
    $('.myCheckbox').change(function() {
        if($(this).is(':checked')) {
          var inputeQuestionText = $(this).closest(".questionBox").find(".inpuetanswerbox").val();
          var inputeElemet = $(this).closest(".questionBox").find(".inpuetanswerbox");


          inputeElemet.val(inputeQuestionText + "***R");
 
    
        } else {
        
            var inputeElemet = $(this).closest(".questionBox").find(".inpuetanswerbox");
            var inputeQuestionText = $(this).closest(".questionBox").find(".inpuetanswerbox").val();

           var newval =  inputeQuestionText.replace('***R',"");
            inputeElemet.val(newval);
        }
      });

      $(".submitPaperbtnMultiple").click(function (e) { 
        e.preventDefault();
        $(this).addClass("submitPaperbtncclicked");
        var choise1 = $(this).closest(".mainouterdiv").find(".choice1").val();
        var choise2 = $(this).closest(".mainouterdiv").find(".choice2").val();
        var choise3 = $(this).closest(".mainouterdiv").find(".choice3").val();
        var choise4 = $(this).closest(".mainouterdiv").find(".choice4").val();
        var choise5 = $(this).closest(".mainouterdiv").find(".choice5").val();

        var errorshow = $(this).closest(".singelAnwerquestion").find(".shwoemsshe") ;


 

 
        var questionNumber = $(this).closest(".mainouterdiv").find(".questionumber").val();

        var questionText = $(this).closest(".mainouterdiv").find(".whatisQuestion").val();


 


        var data = "choise1_next=" + choise1  + "&choise2_next=" +choise2 + "&choise3_next=" +choise3 + "&choise4_next="+ choise4+"&choise5_next="+ choise5 + "&questionNumber_next=" +questionNumber+"&questionText_next="+questionText;


        $.ajax({
            type: "POST",  
            url: "insert_multiple_question.php",  
            data: data,   
          
            success: function (response) {  
              errorshow.html(response);
            },
            
        })

        
      });

});