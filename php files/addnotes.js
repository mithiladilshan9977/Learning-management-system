$(document).ready(function () {
    $("#okbtn").click(function (e) { 
        e.preventDefault();
        var theNote = $("#thetextarea").val();
 

 var data = "thenote=" + theNote;
        $.ajax({
            type: "POST",   
            url: "add_note.php",   
            data: data,  
           
           
            success: function (response) {  
                $('.noteaddedmessag').html(response);
            },
           
        })
        
    })
});