<?php
/*
  Plugin Name: 	WP LINE Login
  Plugin URI: 	https://www.boostpress.com/
  Description: 	Login with LINE Provider.
  Version:      2.1
  Author: 	    Boostpress inc.
  Author URI: 	https://www.boostpress.com/
  Text Domain:  wp-linelogin 
  License: 	    commercial
 */

load_plugin_textdomain('wp-linelogin', false, dirname(plugin_basename(__FILE__)) . '/languages');

define('WP_LINE_LOGIN_PLUGIN_DIR_PATH', untrailingslashit(plugin_dir_path(__FILE__)));
define('WP_LINE_LOGIN_PLUGIN_DIR_URL', untrailingslashit(plugin_dir_url(__FILE__)));

require_once(WP_LINE_LOGIN_PLUGIN_DIR_PATH.'/license.php');
require_once(WP_LINE_LOGIN_PLUGIN_DIR_PATH.'/LINE-SDK/linelogin.php');

class WP_LINE_Login
{
    private $client_id;
    private $client_secret;
    private $callback_url;

    public function __construct()
    {
        $this->load_props();


        /**
         * Add settings link under plugin name on plugins page.
         */
        add_filter('plugin_action_links', array($this, 'plugin_action_links'), 10, 2);


        /**
         * Register settings menu 
         */
        add_action('admin_menu', array($this, 'register_settings_menu'));
        add_action('admin_menu', array($this, 'register_lineprofile_menu'));


        /**
         * Save settings
         */
        add_action('init', array($this, 'save_settings'));


        /**
         * Register shortcode
         */
        add_action('init', array($this, 'register_shortcode'));


        /**
         * Register LINE Login button
         */
        add_action('login_form', array($this, 'wordpress_login_form'));
        add_action('register_form', array($this, 'wordpress_login_form'));
        add_action('woocommerce_login_form_end', array($this, 'woocommerce_login_form'));
        add_action('woocommerce_register_form_end', array($this, 'woocommerce_login_form'));


        /**
         * LINE Login callback
         */
        add_action('init', array($this, 'login_or_register'));


        /**
         * Logout, destroy access token
         */
        add_action('wp_logout', array($this, 'remove_line_token'));


        /**
         * Register css, javascript on login page
         */
        add_action('login_enqueue_scripts', array($this, 'register_login_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'frontend_enqueue_scripts'));


        /**
         * Register admin script
         */
        add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));


        /**
         * AJAX
         */
        add_action('wp_ajax_wp_line_login_revoke', array($this, 'ajax_wp_line_login_revoke'));

        
        /**
         * Enable license
         */
        $this->license = new Boostpress\Plugins\WP_LINE_Login\License();
 
    }


    /**
     * Register admin scripts
     */
    public function register_admin_scripts()
    {
        wp_enqueue_script('wp-line-admin', WP_LINE_LOGIN_PLUGIN_DIR_URL.'/js/wp-line-admin.js', array('jquery'));
    }


    /**
     * AJAX
     */
    public function ajax_wp_line_login_revoke()
    {
        $user = wp_get_current_user();
        $token = get_user_meta($user->ID, 'line-login-token', true);

        $linelogin = new \Boostpress\Plugins\WP_LINE_Login\linelogin(
            $this->client_id, 
            $this->client_secret, 
            $this->callback_url);

        $revoke = $linelogin->revoke($token->access_token);

        if(!empty($revoke)){
            wp_send_json_error('Disconnect LINE error. Please try again.');
        }else{
            update_user_meta($user->ID, 'line-login-token', '');
            update_user_meta($user->ID, 'line-login-profile', '');
            update_user_meta($user->ID, 'line-login-friendship', '');

            // Automatic logout
            wp_logout();
            wp_send_json_success('Disconnect LINE completely.');
        }
    }


    /**
     * Remove line token when user logout
     */
    public function remove_line_token($user_id)
    {
        update_user_meta($user_id, 'line-login-token', '');
    }


    /**
     * Register CSS and JS on wordpress login page
     */
    public function register_login_scripts()
    {
        wp_enqueue_style( 'wp-line-login', WP_LINE_LOGIN_PLUGIN_DIR_URL.'/css/wp-line-login.css' );
        wp_enqueue_script('wp-line-login', WP_LINE_LOGIN_PLUGIN_DIR_URL.'/js/wp-line-login.js', array('jquery'));
    }


    /**
     * Register CSS, JS on frontend page
     */
    public function frontend_enqueue_scripts()
    {
        wp_enqueue_style( 'wp-line-login', WP_LINE_LOGIN_PLUGIN_DIR_URL.'/css/wp-line-login.css' );
    }


    /**
     * Load variables
     */
    public function load_props()
    {
        $settings = $this->get_settings();

        $this->client_id = $settings['channel_id'];
        $this->client_secret = $settings['channel_secret'];
        $this->callback_url = untrailingslashit(get_site_url());
    }


    /**
     * Add link to settings page under plugin name
     * @param $links
     * @param $file
     * @return mixed
     */
    public function plugin_action_links($links, $file)
    {
        if ($file != plugin_basename(__FILE__)) {
            return $links;
        }

        $settings_link = '<a href="options-general.php?page=line-login-settings">' . __('Settings', 'wp-linelogin') . '</a>';

        array_unshift($links, $settings_link);

        return $links;
    }


    /**
     * Register LINE Profile menu 
     */
    public function register_lineprofile_menu()
    {
        add_submenu_page(
            'users.php',
            'LINE Profile',
            'LINE Profile',
            'read',
            'line-login-profile',
            array($this, 'lineprofile_page_content')
        );
    }


    /**
     * LINE Profile content
     */
    public function lineprofile_page_content()
    {
        $user_id = get_current_user_id();
        $lineprofile = get_user_meta($user_id, 'line-login-profile', true);
        $friendship = get_user_meta($user_id, 'line-login-friendship', true);
        ?>
        <div class="wrap" id="lineprofile-page">
            <h1 class="wp-heading-inline">LINE Informations</h1>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr class="user-user-login-wrap">
                        <th><label>LINE ID</label></th>
                        <td><?php echo $lineprofile->userId; ?></td>
                    </tr>
                    <tr class="user-user-login-wrap">
                        <th><label>Profile</label></th>
                        <td><img width="80" src="<?php echo $lineprofile->pictureUrl; ?>" /></td>
                    </tr>
                    <tr class="user-user-login-wrap">
                        <th><label>Display Name</label></th>
                        <td><?php echo $lineprofile->displayName; ?></td>
                    </tr>
                    <tr class="user-user-login-wrap">
                        <th><label>Status</label></th>
                        <td><?php echo $lineprofile->statusMessage; ?></td>
                    </tr>
                    <tr class="user-user-login-wrap">
                        <th><label>LINE Official Friend</label></th>
                        <td><input type="button" value="<?php if($friendship){ echo 'Connected';}else{ echo 'Not Connect';} ?>" disabled /></td>
                    </tr>
                    <tr class="user-user-login-wrap">
                        <th></th>
                        <td><input type="button" value="Disconnect LINE" id="wp-line-login-revoke" /></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <?php 
    }


    /**
     * Register settings menu 
     */
    public function register_settings_menu()
    {
        add_submenu_page(
            'options-general.php',
            'LINE Login Settings',
            'LINE Login Settings',
            'manage_options',
            'line-login-settings',
            array($this, 'settings_page_content')
        );
    }


    /**
     * Save settings
     */
    public function save_settings()
    {
        if( (isset($_POST['line-login-settings-postback']) && $_POST['line-login-settings-postback'] == 'yes') &&  
            wp_verify_nonce($_POST['_wpnonce'], 'line-login-settings'))
        {
            update_option('line-login-settings', $_POST['line-login-settings']);
            add_action('admin_notices', function(){
                echo '<div class="notice notice-success settings-error is-dismissible">
                        <p>Settings has saved.</p>
                    </div>';
            });
        }
    }


    /**
     * Get settings
     */
    public function get_settings()
    {
        $defaults = array(
            'channel_id'        => '',
            'channel_secret'    => '',
            'login_text'        => 'Login with LINE',
            'logout_text'       => 'Logout',
        );
        $line_login_settings = get_option('line-login-settings');
        $settings = wp_parse_args($line_login_settings, $defaults);

        return $settings;
    }


    /**
     * Settings page content
     */
    public function settings_page_content()
    {
        $settings = $this->get_settings();
        ?>
        <div class="wrap">
            <h1><?php _e('LINE Login Settings', 'wp-linelogin'); ?></h1>

            <form method="post" action="options-general.php?page=line-login-settings" novalidate="novalidate">
                <input type="hidden" name="line-login-settings-postback" value="yes" />
                <?php wp_nonce_field('line-login-settings'); ?>
                <table class="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="channel_id">Channel ID</label></th>
                            <td><input name="line-login-settings[channel_id]" type="text" id="channel_id" value="<?php echo $settings['channel_id']; ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="channel_secret">Channel Secret</label></th>
                            <td><input name="line-login-settings[channel_secret]" type="text" id="channel_secret" value="<?php echo $settings['channel_secret']; ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="callback_url">Callback URL</label></th>
                            <td><?php echo $this->callback_url; ?></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="login_text">Login Text</label></th>
                            <td><input name="line-login-settings[login_text]" type="text" id="login_text" value="<?php echo $settings['login_text']; ?>" class="regular-text"></td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="logout_text">Logout Text</label></th>
                            <td><input name="line-login-settings[logout_text]" type="text" id="logout_text" value="<?php echo $settings['logout_text']; ?>" class="regular-text"></td>
                        </tr>

                    </tbody>
                </table>

                <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="บันทึกการเปลี่ยนแปลง"></p>
            </form>
        </div>
    <?php
    }


    /**
     * Register shortcode
     */
    public function register_shortcode()
    {
        add_shortcode( 'line_login_button', array($this, 'line_login_button_shortcode') );
    }


    /**
     * Shortcode content
     */
    public function line_login_button_shortcode()
    {
        ob_start();

        $this->print_line_login_button('yes');

        return ob_get_clean();
    }


    /**
     * Wordpress login/register form
     */
    public function wordpress_login_form()
    {
        global $wp;

        if(!session_id()){
            session_start();
        }
        $_SESSION['wp_line_login-from'] = home_url( $wp->request );
        $_SESSION['wp_line_login-to'] = get_admin_url();

        $this->print_line_login_button();
    }


    /**
     * Woocommerce login/register form
     */
    public function woocommerce_login_form()
    {
        global $wp;

        if(!session_id()){
            session_start();
        }
        $_SESSION['wp_line_login-from'] = home_url( $wp->request );
        $_SESSION['wp_line_login-to'] = home_url( $wp->request );

        $this->print_line_login_button();
    }


    /**
     * Print line button
     */
    public function print_line_login_button($button_only = 'no')
    {
        $linelogin = new \Boostpress\Plugins\WP_LINE_Login\linelogin(
            $this->client_id, 
            $this->client_secret, 
            $this->callback_url);
        if($button_only != 'yes'){
        ?>
        <div id="wp-line-login" class="wp-line-login-container">
            <div class="wp-line-login-row"  >
                <div class="wp-line-login-col"><hr class="wp-line-login-hr"></div>
                <div class="wp-line-login-or">หรือ</div>
                <div class="wp-line-login-col"><hr class="wp-line-login-hr"></div>
            </div>
            <div class="wp-line-login-row"  >
                <div class="wp-line-login-col">&nbsp;</div>
                <div class="wp-line-login-or">
                    <a href="<?php echo $linelogin->getLink(7); ?>">
                        <img width="64" src="<?php echo WP_LINE_LOGIN_PLUGIN_DIR_URL.'/images/line-round-icon.png'; ?>" />
                    </a>
                </div>
                <div class="wp-line-login-col">&nbsp;</div>
            </div>
        </div>
        <?php 
        }else{
            ?>
            <a href="<?php echo $linelogin->getLink(7); ?>">
                <img width="64" src="<?php echo WP_LINE_LOGIN_PLUGIN_DIR_URL.'/images/line-round-icon.png'; ?>" />
            </a>
            <?php 
        }

    }


    /**
     * Register account
     */
    public function login_or_register()
    {
        if(!session_id()){
            session_start();
        }

        if(isset($_GET['code']) && isset($_GET['state'])){
            $linelogin = new \Boostpress\Plugins\WP_LINE_Login\linelogin(
                $this->client_id, 
                $this->client_secret, 
                $this->callback_url);

            $code = $_GET['code'];
            $state = $_GET['state'];
            $token = $linelogin->token($code, $state); 
            $token = json_decode($token);

            // Check profile
            if(isset($token->error)){
                wp_safe_redirect($_SESSION['wp_line_login-from']);
                die();
            }else{
                $id_token = $token->id_token;
                $verification = $linelogin->verify($id_token);
                $verification = json_decode($verification);
                $email = $verification->email;

                $access_token = $token->access_token;
                $profile = $linelogin->profile($access_token);
                $profile = json_decode($profile);

                $friendship = $linelogin->friendship($access_token);
                $friendship = json_decode($friendship);
                
                // Get user by email
                $user = get_user_by('email', $email);

                // If exist login
                if($user){
                    update_user_meta($user->ID, 'line-login-token', $token);
                    update_user_meta($user->ID, 'line-login-profile', $profile);
                    update_user_meta($user->ID, 'line-login-friendship', $friendship);
                    update_user_meta($user->ID, 'lineofficial_notification_lineid', $profile->userId);

                    // Automatic login 
                    wp_set_current_user($user->ID);
                    wp_set_auth_cookie($user->ID);
                }else{
                    list($username, $domain) = explode('@', $email);
                    $args = array(
                        'user_login' => $username,
                        'user_pass' => wp_generate_password(),
                        'user_email' => $email,
                        'display_name' =>  $profile->displayName,
                    );

                    $user_id = wp_insert_user($args);
                    update_user_meta($user_id, 'line-login-token', $token);
                    update_user_meta($user_id, 'line-login-profile', $profile);
                    update_user_meta($user_id, 'line-login-friendship', $friendship);
                    update_user_meta($user_id, 'lineofficial_notification_lineid', $profile->userId);

                    // Automatic login 
                    wp_set_current_user($user_id);
                    wp_set_auth_cookie($user_id);

                }

                wp_safe_redirect($_SESSION['wp_line_login-to']);
                die();
            }
        }
    }

}

new WP_LINE_Login();
