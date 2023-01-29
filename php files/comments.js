 


$(document).ready(function () {
 
    loadComment();
function loadComment(){

var data={
    'load_comment':true,
}


    $.ajax({
        type: "POST",   
        url: "comment.php",   
        data: data,  
       
       
        success: function (response) {   
            

            $.each(response, function (key, value) { 

                $(".comment_container" ).
                append('<div class="reply_box border p-2 mb-2">\
                <h6 class="username">'+value.user['firstname']+ ' : ' + value.user['lastname'] + '</h6>\
                <p class="para">'+value.cmt['content'] +' </p>\
                <button value ="'+value.cmt['teacherClassNotifiID'] +'"  class="badge btn btn-warning reply_btn">Reply</button>\
                <button value ="'+value.cmt['teacherClassNotifiID'] +'"  class="badge btn btn-danger view_reply_btn">View replays</button>\
                <div class="ml-4 reply_Section">\
             </div>\
       </div>\
            ');
                 
            });
        },
         
        
    })
}



});