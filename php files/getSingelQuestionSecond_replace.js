$(document).ready(function () {
     
    $(".navigateButton").click(function (e) { 
        e.preventDefault();

        var questionnumber = $(this).closest(".buttonHolder").find(".inputNumberField").val();
        var counterval = $(this).closest(".buttonHolder").find(".inputFieldCounter").val();
     

        var data = "questionnumber_next="+questionnumber + "&counterval_next=" + counterval;
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