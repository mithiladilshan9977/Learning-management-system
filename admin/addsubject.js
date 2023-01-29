$(document).ready(function () {

$("#addsubjectbtn").on('click' , function(){
    var thecode =  $("#subjectcode").val();
    var subjectTitle =  $("#subjectTitle").val();

    var semester =  $("#semester").val();
    var descrition = $("#discription").val();
     var data = "thecode=" + thecode + "&subjecttitile=" + subjectTitle + "&semester=" + semester + "&descrition=" + descrition;
      $.ajax({
            
             url:"add_new_subject.php?",
             method:"post",
             data:data,

             success:function(data){
          $(".subjectResult").html(data);
             }
      });
});

       

});