$(document).ready(function () {
    $(".crossimage").click(function (e) { 
        e.preventDefault();

        var thecloseDiv =  $(this).closest(".notediv").find('#removeNote').val();
 

        var data = "thenoteID=" + thecloseDiv;
 
        $.ajax({
            type: "POST",  
            url: "removenote.php",   
            data: data,   
         
      
            success: function (response) {   
                $('.noteremovemassage').html(response);
            },
            
        })
     
        
    })
});