$(document).ready(function () {
 
         $('#personmainDiv').on('change' , function(){
            var thepersonvalue = $('#personmainDiv').val();
            var thedepartmntDiv = $('#showdeparmnetsnewwww');
            
            if(thepersonvalue  == 'coordinator')
            {
                thedepartmntDiv.slideDown(100);
            }else if (thepersonvalue  == 'admin'){
                thedepartmntDiv.slideUp(100);
            }
         });
     
     
   

});
