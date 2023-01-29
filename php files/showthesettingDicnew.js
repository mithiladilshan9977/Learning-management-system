 
 
$(document).ready(function () {
    
    $("#theseeetingicon").click(function (e) { 
        e.preventDefault();
    
       $(this).toggleClass("rotateSetting");
        var thedropDown = $(".showsetting").slideToggle(100);
        
    });

 
});