  
$(document).ready(function(){
 
 
  
    $('#submitformee').on('click' , function(){
               var theusername = $("#theusername").val();
               var thepassword = $("#thepassword").val();
               var person = $("#personnew").val();
           
       
                  var data = "theusername=" + theusername + "&thepassword=" + thepassword +"&person=" + person;
               $.ajax({
                       method : "post",
                      url:"authenticateuser.php?",
                      
                      data : data,

                      success:function(data){
                           $("#showthemassage").html(data);
                      }
               });
    });

   });