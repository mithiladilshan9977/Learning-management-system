$(document).ready(function () {

 

    $("#NowstartExamBTtn").click(function (e) { 
        e.preventDefault()
 
        $.ajax({
          
            url: "startTheExamNow.php",   
           
            dataType: "html",
          
            success: function (response) {   
                $(".showthemesssgae").html(response);
            },
             
        })
        
    })
    
});