$(document).ready(function () {
    $(".navigateButton").click(function (e) { 
        e.preventDefault();

        var questionnumber = $(this).closest(".buttonHolder").find(".inputNumberField").val();
        var data = "questionnumber_next="+questionnumber;
        $.ajax({
            type: "POST",   
            url: "getsinglequestionSecond.php",   
            data: data,  
           
            success: function (response) {   
                $(".addquestion").html(response);
            },
           
        })
        
    })
});