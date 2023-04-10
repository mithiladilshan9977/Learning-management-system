$(document).ready(function () {
    
    var body = $(".body") ;
   document.addEventListener('visibilitychange', function(){
  if(document.visibilityState==='visible')
  {
      

                  var data = "newdata=" + document.visibilityState;
      $.ajax({
          type: "POST",  //默认get
          url: "exam_mistakes.php",  //默认当前页
          data: data,  //格式{key:value}
        
          
          success: function (response) {  //请求成功回调
              $(".showtheErrorText").html(response);
               $(".hswotheerror").addClass("name");
             
              
                setTimeout(() => {
              $(".showtheErrorText").html("");
              $(".hswotheerror").removeClass("name")
                }, 5000);
          },
           
      })
      

  } 

   });
  
 
   
});