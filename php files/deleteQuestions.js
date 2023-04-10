$(document).ready(function () {
    $(".delteQuestion").click(function () {
        
        var updateQuestionHolder = $(this).closest(".buttonsHolder").find(".thisIsTheQuestionNumber").val();
        var buttonsHolder =  $(".deletdquestionmessge");

        var data = "updateQuestionHolder_next=" +updateQuestionHolder  ;
    

        $.ajax({
            type: "POST",   
            url: "deletedQuestionInPaper.php",   
            data: data,   
            
            success: function (response) {   
    
                buttonsHolder.html(response)
            },
           
        })


    });
});