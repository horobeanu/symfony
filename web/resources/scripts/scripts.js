
$(document).ready(function() {

    $("#ajax_loading_div")
        .bind("ajaxSend", function(){
            $(this).show();
        })
        .bind("ajaxComplete", function(){
            $(this).hide();
        });
    
});
    