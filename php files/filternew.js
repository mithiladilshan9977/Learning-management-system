$(document).ready(function () {
 
    $("#setdefault").click(function (e) { 
        e.preventDefault();
        $(".containernew").removeClass('boxesFilter');
        $(".rowsFilertDiv").addClass("boxesFilter");
        
    });


    $("#setrows").click(function (e) { 
        e.preventDefault();
       $(".containernew").addClass('boxesFilter');
       $(".rowsFilertDiv").removeClass("boxesFilter");
        
    })
});