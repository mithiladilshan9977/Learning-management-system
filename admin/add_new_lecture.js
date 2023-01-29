
 

   $(document).ready(function () {
    
       $("#okbtnnow").on('click', function(){
         
       
           var LectFirstName = $("#LectFirstName").val();
           var LectLastName = $("#LectLastName").val();
   
           var data =  "LectFirstName=" + LectFirstName + "&LectLastName=" + LectLastName;
               
           $.ajax({
                     url:"insert_new_lecture.php?",
                     method:"post",
                     data:data,
                     success:function(data){
                       $(".showmasssage").html(data);
                     }
           });
   
   
       });
   });