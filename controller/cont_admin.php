<?php

class Cont_Admin {

    //Define set option array
    public $set_options = array();
    //Define shortcode option array
    public $shortcode_options = array();
    //initial storage of affiliate id value in option table
    private $settings_option_value = array(
        'affiliate_id' => 12345,
    );
    //initial storage of theme colors
    private $shortcode_option_value = array(
        'custom_width' => '700',
        'border_color' => '#5a5a5a',
        'background_color' => '#b92525',
        'text_color' => '#ffffff',
        'button_color' => '#ffffff',
        'button_text_color' => '#b92525',
    );

    //call constructor		
    public function Cont_Admin() {
        $this->__construct();
    }

    //constructor
    public function __construct() {

        //Register activation process
        register_activation_hook(SF_TRAVELSHOPPING__FILE__, array($this, 'shopnfly_activate'));
        //Register deactivatin process
        register_deactivation_hook(SF_TRAVELSHOPPING__FILE__, array($this, 'shopnfly_deactivate'));
        //Add Admin menu
        add_action('admin_menu', array($this, 'sfts_create_menu'));
        //To enable action of options.php
        add_action('admin_init', array($this, 'admin_initialization'));
        //Shorcode Registration
        add_shortcode('sf_travel_shop', array($this, 'travel_shop_shortcode'));
        add_action('admin_head', array($this, 'editor_sfts_button'));
    }

    //initialize admin
    function admin_initialization() {
        // registering the settings page storage
        register_setting('sfts_settings_value', 'sfts_settings_value');
        register_setting('shortcode_default_rectangle', 'shortcode_default_rectangle');
        register_setting('shortcode_default_wide', 'shortcode_default_wide');
        register_setting('shortcode_default_narrow', 'shortcode_default_narrow');
        register_setting('shortcode_default_dynamic-width', 'shortcode_default_dynamic-width');
    }

    //Activation Process
    function shopnfly_activate() {
        $this->set_options = $this->settings_option_value;
        $this->shortcode_options = $this->shortcode_option_value;
        add_option('sfts_settings_value', $this->set_options, '', 'yes');
        add_option('shortcode_default_rectangle', $this->shortcode_options, '', 'yes');
        add_option('shortcode_default_wide', $this->shortcode_options, '', 'yes');
        add_option('shortcode_default_narrow', $this->shortcode_options, '', 'yes');
        add_option('shortcode_default_dynamic-width', $this->shortcode_options, '', 'yes');
        return true;
    }

    //Deactivation Process
    function shopnfly_deactivate() {
        delete_option('sfts_settings_value');
        delete_option('shortcode_default_rectangle');
        delete_option('shortcode_default_wide');
        delete_option('shortcode_default_narrow');
        delete_option('shortcode_default_dynamic-width');
        deactivate_plugins(basename(SF_TRAVELSHOPPING__FILE__));
        return true;
    }

    //Creat Menu
    function sfts_create_menu() {
        add_menu_page(
                // page title
                'Online Pre-Travel Shopping',
                // menu title
                'Online Pre-Travel Shopping',
                // this menu will be displayed for users w/ rights to manage options
                'manage_options',
                // The slug name to refer to this menu by (should be unique for this menu)
                'sfts-settings',
                // The function that displays the page content for the menu page
                array($this, 'sfts_setting_page')
        );
        add_submenu_page(
                // parent page slug
                'sfts-settings',
                // page title
                'Online Pre-Travel Shopping Demo Page',
                // menu title
                'Demo Page',
                // this sub-menu will be displayed for users w/ rights to manage options
                'manage_options',
                // the slug name to refer to this menu by (should be unique for this menu)
                'sfts_demo',
                // the function to be called to output the content for this page.
                array($this, 'sfts_demo_view')
        );
    }

    //Settings Page View Function
    function sfts_setting_page() {
        include(SF_TRAVELSHOPPING_ABSPATH . 'views/admin/settings.php');
    }

    //Demo page View function
    function sfts_demo_view() {
        include(SF_TRAVELSHOPPING_ABSPATH . 'views/admin/demo_page.php');
    }

    //Shortcode to display in frontend.
    function travel_shop_shortcode($atts) {
        extract(shortcode_atts(array(
            't' => '',
            'bc' => '',
            'bac' => '',
            'tc' => '',
            'buc' => '',
            'butc' => '',
            'w' => '',
            'h' => ''
                        ), $atts));

        $themes = $atts['t'];
        $border_color = $atts['bc'];
        $background_color = $atts['bac'];
        $text_color = $atts['tc'];
        $button_color = $atts['buc'];
        $button_text_color = $atts['butc'];
        $custom_width = $atts['w'];
        $custom_height = $atts['h'];
        ob_start();
        include(SF_TRAVELSHOPPING_ABSPATH . 'views/front/search_form.php');
        $output = ob_get_clean();
        return $output;
    }

    function editor_sfts_button() {
        global $typenow;
        // only on Post Type: post and page
        if (!in_array($typenow, array('post', 'page')))
            return;
        add_filter('mce_external_plugins', array($this, 'sfts_add_tinymce_plugin'));
        // Add to line 1 form WP TinyMCE
        add_filter('mce_buttons', array($this, 'sfts_add_tinymce_button'));
    }

    // inlcude the js for tinymce
    function sfts_add_tinymce_plugin($plugin_array) {
        $plugin_array['sfts_plugin_arr'] = plugins_url('../js/tinymce.js', __FILE__);
        return $plugin_array;
    }

    // Add the button key for address via JS
    function sfts_add_tinymce_button($buttons) {
        array_push($buttons, 'sfts_button_key');
        return $buttons;
    }

}

?>