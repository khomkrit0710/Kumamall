(function($){
    $(document).ready(function(){
        var linelogin = $('#wp-line-login').detach()

        linelogin.appendTo('#loginform');
        linelogin.appendTo('#registerform');
    });
})(jQuery);
