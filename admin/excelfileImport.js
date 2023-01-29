$(document).ready(function () {
    $("#excelfile").click(function (e) { 
        e.preventDefault();
  
        $.ajax({
            type: "POST",  //默认get
            url: "importExcel.php",  //默认当前页
            data: data,  //格式{key:value}
          
            success: function (response) {   
                
            },
             
            
        })
        
    })
});