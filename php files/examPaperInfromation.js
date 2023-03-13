$(document).ready(function () {
 
    $("#savebtn").click(function (e) { 
        e.preventDefault();
 
        var nameofpaper = $("#nameofpaper").val();
        var timeInHours = $("#timeInHours").val();
        var timeInMinutes = $("#timeInMinutes").val();
        var closesPassword = $("#closesPassword").val();
        var repeatPassword = $("#repeatPassword").val();
        var limitTo = $("#limiteTo").val();

 
        var data = "nameofpaper=" + nameofpaper + "&timeInHours=" + timeInHours + "&timeInMinutes=" + timeInMinutes + "&closesPassword=" + closesPassword + "&repeatPassword=" + repeatPassword + "&limitTo="+limitTo;

        $.ajax({
            type: "POST",   
            url: "insertExamInfro.php",   
            data: data,   
        
            success: function (response) {   
             $(".showthemesssgae").html(response)   ;
            },
            
        });


        
        
    })
});