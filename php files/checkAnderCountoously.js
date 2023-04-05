$(document).ready(function () {
 
    $(".navigateButton").click(function (e) { 
        e.preventDefault();
     

        var questionNumber = $(this).closest(".buttonHolder").find(".inputNumberField").val();
        var spanTag = $(this).closest(".buttonHolder").find(".greenisonholder");


        var data =   "questionNumber_next=" + questionNumber;

        setInterval(() => {
            $.ajax({
                type: "POST",   
                url: "checkAnswredOrNot.php",  
                data: data,   
                
                success: function (response) {   
                    spanTag.html(response);
                },
               
              });

        }, 1000);

      

       

    });

 
         
          
 
     
    
    });