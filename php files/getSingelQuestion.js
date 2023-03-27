$(document).ready(function () {
    $(".butonAnchrs").click(function (e) { 
        e.preventDefault();
     
        var questionNumber = $(this).closest(".btubHolder").find(".buttonquestionNumber").val();
        var data = "questionNumber_next="+questionNumber;
        $.ajax({
            type: "POST",  //默认get
            url: "selectSingelQuestion.php",  //默认当前页
            data: data,  //格式{key:value}
          
          
            success: function (response) {   
                  $(".newspan").html(response);
            },
            
        })
    })
    
});