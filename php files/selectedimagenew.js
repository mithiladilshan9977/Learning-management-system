$(document).ready(function () {
    
   
    $(".classimage").click(function (e) { 
        var imageid=  $(this).closest('.newlist').find(".imageid").val();

     $(".setimage").click(function (e) { 
        e.preventDefault();
        var thebatchid = $(".theoprionValue").val();
   

        var data =  "imageid=" + imageid + "&thebatchid=" + thebatchid;


        $.ajax({
            type: "POST",   
            url: "updateimage.php",   
            data: data,   
           
          
            success: function (response) {   
                $(".showimagemessage").html(response);
            },
           
        })



     });

      

       
        
    })
});