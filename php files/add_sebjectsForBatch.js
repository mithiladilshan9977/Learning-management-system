
       
 

$(document).ready(function () {
    $("#AddNewBatch").on('click' , function(){
        var selectedbatch_new = $("#selectedbatch").val();
        var selectedsubject_new = $("#selectedsubject").val();
      

 
        var data = "selectedbatch=" + selectedbatch_new + "&selectedsubject=" + selectedsubject_new + "&BatchID="  ;

        $.ajax({
                 url:"ajaxsubject_batch.php?",
                 method:"post",
                 data:data,
                 success:function(data){
                    $(".message").html(data);
                 }
        });

    });
});