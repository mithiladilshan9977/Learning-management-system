$(document).ready(function () {
   
 
    var hoursgiver = $("#setHours").val();
    var munitesgiver = $("#setMunites").val();


    var hours = hoursgiver;
  var addonehours = hours;
  var munites = munitesgiver;
  var seconds = addonehours * munites * 60;
 
//  const startingNinutes = 10;
//  let time = startingNinutes * 60;

 var obj = setInterval(setUp , 1000);


  function setUp(){

    if(seconds ==0){
      clearInterval(obj);
 
 
     var ouertButtonHolder =  $(".ouertButtonHolder");
     var whatisquestionbox =  $(".whatisquestionbox");
     var optionsBox =  $(".optionsBox");
     var examovertextshow =  $(".examovertextshow");

 
     ouertButtonHolder.addClass("hideDives");
     examovertextshow.removeClass("hideDives");
     whatisquestionbox.addClass("hideDives");
     optionsBox.addClass("hideDives");
    
 
      
    }
   
    let realhour = Math.floor(seconds/ (munites * 60) );
  
    let secondsreal = seconds % 60;
    const minuetseee = Math.floor(seconds/(60*addonehours));
     
  var timmer = $(".timmer");
  var showthetimmerdiv = $(".showthetimmer");
       
 timmer.html(realhour +  ':' +  minuetseee + ':' +secondsreal );
 showthetimmerdiv.val(realhour +  ':' +  minuetseee + ':' +secondsreal );
 seconds--;
 
    
  }
});
