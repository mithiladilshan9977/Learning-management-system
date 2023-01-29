 $(document).ready(function () {
    $(".reply_btn").click(function (e) { 
        e.preventDefault();
   
        $(this).closest(".reply_box").find(".reply_Section").slideToggle(200);
         var thebtn = $(this).closest(".reply_box").find(".reply_btn").val();
          
         var data = "thebtnvalue=" + thebtn;

         $.ajax({
            type: "POST",  
            url: "gettingstudentsRepayes.php",  
            data: data,   
        
           
            success: function (response) {   
                $(".reply_Section").html(response);
            },
             
           
         })
       
    
        
    })
 });

 