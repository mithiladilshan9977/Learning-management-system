$(document).ready(function () {
    $(".mulipleSelectDropdown").change(function (e) { 
        e.preventDefault();
        var valueSelected = $(this).val();
        var nearDiv = $(this).closest(".singelAnwerquestion").find(".innerdiv");
     
        var data = "valueSelected_next=" + valueSelected;
        $.ajax({
            type: "POST",   
            url: "loadMulpleQuestion.php",   
            data: data,   
          
          
            success: function (response) {  
                nearDiv.html(response);
            },
           
        })
        
    });
});