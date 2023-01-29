$(document).ready(function () {
    $(".updateimage").click(function (e) { 
        e.preventDefault();
        var theupdatbtnval = $(this).closest('.notediv').find("#updatebtn").val();
        var data = "theupdatbtnval=" + theupdatbtnval;

        $.ajax({
            type: "POST",  
            url: "updatenote.php",   
            data: data,   
            success: function (response) {   
                $(".notemessagenew").html(response);
            },
            
        })
    })
});