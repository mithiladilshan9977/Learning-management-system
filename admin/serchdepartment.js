$(document).ready(function () {
    $("#serachsubject").on('keyup', function(){
             var input = $(this).val();
              
             var data =   "inputrText=" + input;   
             if(input !=""){
                    
                $.ajax({

                    url:"live_department_serach.php?",
                    method : "post",
                    data : data,

                    success:function (data) {
                          $(".showserachresult").html(data);
                      }

                });
                
             }
    });
});