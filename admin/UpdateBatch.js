$(document).ready(function () {
    $("#updatebutton").on('click' , function(){
        var batchID = $("#batchID").val();
        var BatchName = $("#exampleInputEmail1").val();
            var data = "batchID=" + batchID + "&BatchName=" + BatchName;
         $.ajax({
                     url:"Update_new_Batch.php?",
                     method:"post",
                     data:data,
                     success:function(data){
                        $(".message").html(data);
                     }
         });

          
    });
});