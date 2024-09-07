(function($){
    $(document).ready(function(){

        $('#wp-line-login-revoke').click(function(){
            if(confirm('Are you sure. You want to Disconnect LINE account from Wordpress?')){
                
                $('#wp-line-login-revoke').val('Disconnecting');
                
                var data = {
                    'action': 'wp_line_login_revoke',
                };
    
                // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                jQuery.post(ajaxurl, data, function(response) {
                    debugger;
                    if(response.success){
                        alert(response.data);
                        window.location = '/wp-login.php';
                    }else{
                        alert(response.data);
                    }
                });
            }
        });
       
    });
})(jQuery);
