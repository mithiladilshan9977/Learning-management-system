$(document).ready(function () {
     $("#AddNewBatch").on('click', function(){

        
     
         var bathcname =  $("#batchname").val();
         var data = "bathcname=" + bathcname;



        $.ajax({
                url:"add_New_Batch.php?",
                method:"post",
                data: data,

                success:function(data){
                     $(".showthebatch").html(data);
                }
        });
     });
});