$(document).ready(function () {
 
 
 
    $(".updateAfterCreatedBtn").click(function (e) { 
      e.preventDefault();
  
    
      var clickbtn = $(this).text();
      if(clickbtn=='Update'){
        $(this).text("Drop down")
      }else{
        $(this).text("Drop down")

      }
      
      var questionnumber = $(this).closest(".buttonsHolder").find(".thisIsTheQuestionNumber").val();
      var singelResposeHolder = $(this).closest(".buttonsHolder").find(".singelResposeHolder");
      $(singelResposeHolder).slideToggle();
      var data = "questionnumber_next=" + questionnumber;
      
  
  
      $.ajax({
          type: "POST",   
          url: "updateAfterCreated.php",   
          data: data,   
         
          success: function (response) {   
              singelResposeHolder.html(response);
      
  
          },
          
      })
      
    });
  });