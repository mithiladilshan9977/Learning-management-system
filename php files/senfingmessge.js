$(document).ready(function () {
    $("#sendingbtn").click(function (e) { 
        e.preventDefault();
         var commentText = $("#messgaeText").val();
         var reciverID = $("#reciverID").val();

        

         var data = "commentText=" + commentText + "&reciverID=" + reciverID;
         $.ajax({
            type: "POST",   
            url: "insertChatMessage.php",   
            data: data,   
          
            success: function (response) {   
                var commentText = $("#messgaeText").val(""); 
            },
            
         })
        
    })
});