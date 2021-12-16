function case_alert_redir(div_alert, redirect, time) {
    $("#"+div_alert).fadeIn('slow', function(){
        setTimeout(function() {
                $("#"+div_alert).fadeOut('slow', function(){
                    window.location = redirect;
                });
        }, time);
    });
};

function case_alert(div_alert, time) {
    $("#"+div_alert).fadeIn('slow', function() {
        setTimeout(function() {
            $("#"+div_alert).fadeOut('slow');
        }, time);
    });
};