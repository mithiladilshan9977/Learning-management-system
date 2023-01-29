 
  
 
      $(document).ready(function () {
        
         $(".reply_btn").click(function (e) {


             e.preventDefault()
     
    
             $(this).closest('.reply_box').find('.reply_Section').slideToggle(200);

             var BTNteacherClassNotifiID  = $(this).val();

             var data = "BTNteacherClassNotifiID=" + BTNteacherClassNotifiID
             $.ajax({
                url: "sendingreplays.php",   
                method:"post",
                data: data,  
             
              
                success: function (response) {   
                    
                },
                
             })
        


             
         });




         $(".add_comment_btn").click(function (e) { 
            e.preventDefault();
        
            var ClickeBtnValue = $(this).closest(".reply_box").find('.reply_btn').val();
            var commecnt_text_box =$(this).closest(".reply_box").find('.commecnt_text_box').val();
            $(this).closest(".reply_box").find('.commecnt_text_box').val("");


             var data = "ClickeBtnValue=" + ClickeBtnValue + "&commecnt_text_box=" +commecnt_text_box;
   
            $.ajax({
                type: "POST",  
                url: "insertingReparys.php",  
                data: data,   
         
             
                success: function (response) {  
                   
                    $(".showmessage").html(response);
                },
              
                
            })

             
            
         })



$(".view_reply_btn").click(function (e) { 
    e.preventDefault();
  
    $(this).closest(".reply_box").find(".showstudentreplays").slideToggle(200);
   
    var ClickeBtnValue = $(this).closest(".reply_box").find('.reply_btn').val();
  var data = "ClickeBtnValue=" + ClickeBtnValue;
 

    $.ajax({
        type: "POST",   
        url: "gettingStudentReplys.php",   
        data: data,  
       
     
        success: function (response) {  
            $(".showstudentreplays").html(response);
      
        },
        
    })
    
});

 


      });