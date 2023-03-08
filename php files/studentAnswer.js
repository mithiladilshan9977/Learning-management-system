$(document).ready(function () {
 
    $(".submitStudentAnser").click(function (e) { 
        e.preventDefault();
 var studentGivenAnswer  = $("input[name='question']:checked").val();
 
      
 var data ="studentGivenAnswer=" + studentGivenAnswer;
 

  setInterval(() => {
    $.ajax({
        type: "POST",  //默认get
        url: "checkingStudentAnswer.php",  //默认当前页
        data: data,  //格式{key:value}
        
        
        success: function (response) {  //请求成功回调
            $(".showeeeror").html(response);
        },
        
     })
    
  }, 1000);  

 

          
        
    })
});