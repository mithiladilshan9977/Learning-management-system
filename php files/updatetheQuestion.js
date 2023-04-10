$(document).ready(function () {

    $(".updateThisQuestion").click(function (e) { 
        e.preventDefault();

    var questionnumber = $(this).closest(".updateQuestionHolder").find(".optionIDTOUpdate").val();
    var updatetedOption = $(this).closest(".updateQuestionHolder").find(".updatetedOption").val();
    var updateQuestionCheck = $(this).closest(".updateQuestionHolder").find(".updateQuestionCheck");



  var data = "questionnumber_next=" +questionnumber + "&updatetedOption_next=" +updatetedOption;
 

    $.ajax({
        type: "POST",   
        url: "updatedCreatedQuestion.php",   
        data: data,   
     
        success: function (response) {   
            updateQuestionCheck.html(response);
        },
         
    })

        
    });
});