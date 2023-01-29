$(document).ready(function () {

 
      $("#updatebuttonnew").on('click' , function(){
     
          var studentID = $("#studentID").val();
          var stuFname = $("#stuFname").val();
          var stuLname = $("#stuLname").val();
          var indexnumber = $("#indexnumber").val();
          var selectstudentbatch = $("#selectstudentbatch").val();

          var data = "studentID=" + studentID + "&stuFname=" + stuFname  + "&stuLname=" + stuLname + "&indexnumber=" + indexnumber + "&selectstudentbatch=" + selectstudentbatch;
 

          $.ajax({
                  url:"update_ajax_student.php?",
                  method:"post",
                  data:data,

                  success:function(data){
                    $(".showmassage").html(data);
                  }
          });
      });
});