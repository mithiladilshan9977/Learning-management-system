$(document).ready(function () {
    $("#updatebtn").click(function (e) { 
        e.preventDefault();

        var currentPass = $("#currentpassword").val();
        var newPass = $("#newPass").val();
        var newPassAgain = $("#newpPassAgain").val();

        var data = "currentPass=" + currentPass + "&newPass=" + newPass + "&newPassAgain=" + newPassAgain;

        $.ajax({
            type: "POST",  
            url: "insertNewData.php",   
            data: data,   
      
            success: function (response) {   
                $(".inserterrormessage").html(response);
            },
          
        })
        
    })
});