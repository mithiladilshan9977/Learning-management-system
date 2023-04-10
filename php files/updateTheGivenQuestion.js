$(document).ready(function () {
 
    $(".updatingQuestionGiven").click(function (e) { 
        e.preventDefault();

    var updateQuestionHolder = $(this).closest(".updateQuestionHolder").find(".questioNumberToUpdate").val();
    var updatingQuestion = $(this).closest(".updateQuestionHolder").find(".updatingQuestion").val();
    var showthequestionupdayedmsg = $(this).closest(".updateQuestionHolder").find(".showthequestionupdayedmsg");


    var data = "updateQuestionHolder_next=" +updateQuestionHolder + "&updatingQuestion_nect=" + updatingQuestion;
 

    $.ajax({
        type: "POST",   
        url: "updateGivenQuestion.php",   
        data: data,   
        
        success: function (response) {   
            showthequestionupdayedmsg.html(response);
        },
       
    })


        
    });
});