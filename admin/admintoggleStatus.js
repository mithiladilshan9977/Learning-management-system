 


function admintoggleStatus(id){
    var id = id;
    $.ajax({
        url:"toggle_admin.php?",
        type:"post",
        data:{catId:id},
        success : function(result){
            if(result == '0'){
             alert ("You Unchecked the Changes. Record is not inserted into History.");
                swal("Done!", "You Unchecked the Changes", "success");
            }else{
             
                alert ("You Can Undo the Changes by Unchecking ");

                swal("Done!", "Now you can refresh page", "success");
            }
        }
    });
 }