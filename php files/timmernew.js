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
      
    }
   
    let realhour = Math.floor(seconds/ (munites * 60) );
  
    let secondsreal = seconds % 60;
    const minuetseee = Math.floor(seconds/(60*addonehours));

  var timmer = $(".timmer");
 timmer.html(realhour +  ':' +  minuetseee + ':' +secondsreal );
  
 seconds--;
 
    
  }
});
