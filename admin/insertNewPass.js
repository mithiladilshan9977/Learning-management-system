$(document).ready(function () {
    $("#chagenewpass").click(function (e) { 
        e.preventDefault();
        var newPass = $("#newpassword").val();
        var newPassAgain = $("#newpasswordAgain").val();
        var lecid = $("#lecID").val();

        var data = "newPassAgain=" + newPassAgain + "&newPass=" + newPass + "&lecID=" +lecid;
 
        $.ajax({
            type: "POST",  
            url: "unpdateLecPass.php", 
            data: data,   
         
            success: function (response) {   
                $(".showmessahenw").html(response);
            },
             
        })
    })
});