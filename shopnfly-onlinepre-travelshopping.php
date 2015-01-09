<?php

/*
  Plugin Name: Online Pre-Travel Shopping
  Description: Online Pre-Travel Shopping by shopnfly gives you a revolutionary online, pre-shop shopping search engine, allowing your users to search, compare and buy a massive range of duty free, in air and local retail products from nearly every continent. Products like perfumes, spirits, wines, apparel are just some of the items shoplers like to buy across their trip. With shopnfly, shoplers can buy all these products and more before they even leave home.
  Version: 1.1
  License: GPL 2
 */
/* 16 Dec 2014; J;	 */
if (!defined('ABSPATH') || !defined('WPINC'))
    exit();

/* 	defining abs path to the given plugin directory, plugin dir name+plugin name, abs path to the plugin PHP file	 */
if (!defined('SF_TRAVELSHOPPING_ABSPATH'))
    define('SF_TRAVELSHOPPING_ABSPATH', plugin_dir_path(__FILE__));
if (!defined('SF_TRAVELSHOPPING_BASENAME'))
    define('SF_TRAVELSHOPPING_BASENAME', plugin_basename(__FILE__));
if (!defined('SF_TRAVELSHOPPING__FILE__'))
    define('SF_TRAVELSHOPPING__FILE__', __FILE__);
if (!defined('SF_VER'))
    define('SF_VER', '1.1');

/** 	Include file with the Widget Class	 */
require_once ( SF_TRAVELSHOPPING_ABSPATH . 'widget/sftsWidget.php' );
include_once ( SF_TRAVELSHOPPING_ABSPATH . 'controller/cont_admin.php' );
$cont_admin = new Cont_Admin();
// initializing the widget
add_action('widgets_init', 'sfts_register_widget');

// registering the widget	
function sfts_register_widget() {
    register_widget('sftsWidget');
}

function sf_admin_enqueue_scripts() {

    wp_register_style('sf_farbtastic_css', plugin_dir_url(__FILE__) . 'css/farbtastic.css', false);
    wp_register_style('sf_ui_css', plugin_dir_url(__FILE__) . 'css/sf_ui.css', false);
    wp_register_style('sf_themes_css', plugin_dir_url(__FILE__) . 'css/sf_themes.css', false);
    wp_register_script('sf_admin_jquery_script', plugin_dir_url(__FILE__) . 'js/sf_admin_jquery.js', array('jquery'), '', true);

    wp_enqueue_style('sf_farbtastic_css');
    wp_enqueue_style('sf_ui_css');
    wp_enqueue_style('sf_themes_css');
    wp_enqueue_script('farbtastic');
    wp_enqueue_script('jquery-ui-autocomplete');
    wp_enqueue_script('sf_admin_jquery_script');
}

add_action('admin_enqueue_scripts', 'sf_admin_enqueue_scripts');

function sf_front_enqueue_scripts() {
    wp_register_style('sf_ui_css', plugin_dir_url(__FILE__) . 'css/sf_ui.css', false);
    wp_register_style('sf_themes_css', plugin_dir_url(__FILE__) . 'css/sf_themes.css', false);
    wp_register_script('sf_jquery_script', plugin_dir_url(__FILE__) . 'js/sf_jquery.js', array('jquery'), '', true);

    wp_enqueue_style('sf_ui_css');
    wp_enqueue_style('sf_themes_css');
    wp_enqueue_script('jquery-ui-autocomplete');
    wp_enqueue_script('sf_jquery_script');
}

add_action('wp_enqueue_scripts', 'sf_front_enqueue_scripts');

function theme_update_request() {
    if (isset($_REQUEST)) {
        $req_theme = $_REQUEST['sel_theme'];
    }

    $option_name = 'shortcode_default_' . $req_theme;
    $get_cw_option = get_option('shortcode_default_' . $req_theme, 'custom_width');
    $get_brc_option = get_option('shortcode_default_' . $req_theme, 'border_color');
    $get_bc_option = get_option('shortcode_default_' . $req_theme, 'background_color');
    $get_tc_option = get_option('shortcode_default_' . $req_theme, 'text_color');
    $get_bnc_option = get_option('shortcode_default_' . $req_theme, 'button_color');
    $get_tc_option = get_option('shortcode_default_' . $req_theme, 'button_text_color');

    $obj = array();
    $obj['themes'] = $themes = $req_theme;
    $obj['custom_width'] = $custom_width = ($req_theme == 'dynamic-width') ? esc_attr($get_cw_option[custom_width]) : '';
    $obj['border_color'] = $border_color = esc_attr($get_brc_option[border_color]);
    $obj['background_color'] = $background_color = esc_attr($get_bc_option[background_color]);
    $obj['text_color'] = $text_color = esc_attr($get_tc_option[text_color]);
    $obj['button_color'] = $button_color = esc_attr($get_bnc_option[button_color]);
    $obj['button_text_color'] = $button_text_color = esc_attr($get_tc_option[button_text_color]);

    if ($_REQUEST['mode'] == 'widget') {
        // Always die in functions echoing ajax content
        echo json_encode($obj);
    } else if ($_REQUEST['mode'] == 'shortcode') {
        include(SF_TRAVELSHOPPING_ABSPATH . 'views/admin/sfts_theme/theme.php');
    }
    die();
}

add_action('wp_ajax_theme_update_request', 'theme_update_request');
?>