$(document).ready(function () {
 
    $(".submitPaperbtn").click(function (e) { 
        e.preventDefault();
        $(this).addClass("submitPaperbtncclicked");
        $(this).html("Added");
        var questionnumber = $(this).closest(".container").find(".questionumber").val();
        var whatisQuestion = $(this).closest(".container").find(".whatisQuestion").val();
        var choice1 = $(this).closest(".container").find(".choice1").val();
        var choice2 = $(this).closest(".container").find(".choice2").val();
        var choice3 = $(this).closest(".container").find(".choice3").val();
        var choice4 = $(this).closest(".container").find(".choice4").val();
        var choice5 = $(this).closest(".container").find(".choice5").val();
        var showtheerror = $(this).closest(".container").find(".shwoemsshe");

        var correctNumber = $(this).closest(".container").find(".correctNumber").val();

       
        var data = "questionnumber=" + questionnumber + "&whatisQuestion=" +whatisQuestion + "&choice1=" + choice1 + "&choice2=" + choice2 + "&choice3=" + choice3 + "&choice4=" + choice4 + "&choice5=" + choice5 + "&correctNumber=" + correctNumber;

        $.ajax({
            type: "POST",  //默认get
            url: "insertingQuestion.php",  //默认当前页
            data: data,  //格式{key:value}
            
            success: function (response) {  //请求成功回调
                showtheerror.html(response);
            },
            
        })
         
        
    })
});