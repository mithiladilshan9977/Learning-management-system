$(document).ready(function () {

    $("#anchorrrr").click(function (e) { 
        e.preventDefault();
       var btnval=  $(this).closest(".notediv").find('#noteupdatebtn').val();
       alert(btnval);
        
    })
});