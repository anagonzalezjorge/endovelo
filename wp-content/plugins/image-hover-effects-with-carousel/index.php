<?php
/*
  Plugin Name: Image Hover Effects with Carousel
  Author: Biplob Adhikari
  Plugin URI: https://wordpress.org/plugins/image-hover-effects-with-carousel/
  Description: Image Hover Effects with carousel Plugin For WordPress is all in one image hover effect solution for any kind of WordPress websites.
  Author URI: https://oxilab.org
  Version: 1.1
  License: GPLv2 or later
 */
if (!defined('ABSPATH'))
    exit;

$image_hover_with_carousel_version = '1.1';
define('image_hover_with_carousel_url', plugin_dir_path(__FILE__));

add_shortcode('ihewc_oxi', 'ihewc_oxi_shortcode');

include image_hover_with_carousel_url . 'public-data.php';

function ihewc_oxi_shortcode($atts) {
    extract(shortcode_atts(array('id' => ' ',), $atts));
    $styleid = $atts['id'];
    ob_start();
    ihewc_oxi_shortcode_function($styleid);
    return ob_get_clean();
}

add_action('admin_menu', 'image_hover_with_carousel_menu');

function image_hover_with_carousel_menu() {
    add_menu_page('Image Hover', 'Image Hover', 'manage_options', 'image-hover-carousel', 'image_hover_with_carousel_home');
    add_submenu_page('image-hover-carousel', 'Image Hover', 'Image Hover', 'manage_options', 'image-hover-carousel', 'image_hover_with_carousel_home');
    add_submenu_page('image-hover-carousel', 'New Effects', 'New Effects', 'manage_options', 'image-hover-carousel-new', 'image_hover_with_carousel_new');
    add_submenu_page('image-hover-carousel', 'Other Plugins', 'Others Plugins', 'manage_options', 'image-hover-carousel-more-plugins', 'image_hover_with_carousel_more_plugins');
}

function image_hover_with_carousel_home() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include image_hover_with_carousel_url . 'home.php';
}

function image_hover_with_carousel_new() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include image_hover_with_carousel_url . 'admin.php';
}

function image_hover_with_carousel_more_plugins() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include image_hover_with_carousel_url . 'other-plugins/other-plugins.php';
}

add_action('admin_head', 'add_image_hover_carousel_icons_styles');

function add_image_hover_carousel_icons_styles() {
    ?>
    <style>
        #adminmenu #toplevel_page_image-hover-carousel div.wp-menu-image:before {
            content: "\f115";
        }
    </style>

    <?php
}

register_activation_hook(__FILE__, 'image_hover_effects_with_carousel_install');

function image_hover_effects_with_carousel_install() {
    global $wpdb;
    global $image_hover_with_carousel_version;

    $table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
    $table_list = $wpdb->prefix . 'image_hover_with_carousel_list';

    $charset_collate = $wpdb->get_charset_collate();

    $sql1 = "CREATE TABLE $table_name (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                css text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    $sql2 = "CREATE TABLE $table_list (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
		title varchar(100),
                files varchar(400),
                buttom_text varchar(100),
                link varchar(500),
                image varchar(300),
                css varchar(500),
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql1);
    dbDelta($sql2);

    add_option('image_hover_with_carousel_version', $image_hover_with_carousel_version);
     set_transient('_Ihewc_image_hover_welcome_activation_redirect', true, 30);
}

add_filter('widget_text', 'do_shortcode');
include image_hover_with_carousel_url . 'widget.php';

function ihewc_html_special_charecter($data) {
    $data = str_replace("\'", "'", $data);
    $data = str_replace('\"', '"', $data);
    return $data;
}

function ihewc_font_familly_special_charecter($data) {
    $data = str_replace('+', ' ', $data);
    $data = explode(':', $data);
    $data = $data[0];
    $data = '"' . $data . '"';
    return $data;
}

//Visual Composer Data
if ( ! function_exists( 'is_plugin_active' ) ){
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
if (is_plugin_active('js_composer/js_composer.php')) {
    add_action('vc_before_init', 'ihewc_oxi_VC_extension');
    add_shortcode('ihewc_oxi_VC', 'ihewc_oxi_VC_shortcode');

    function ihewc_oxi_VC_shortcode($atts) {
        extract(shortcode_atts(array(
            'id' => ''
                        ), $atts));
        $styleid = $atts['id'];
        ob_start();
        ihewc_oxi_shortcode_function($styleid);
        return ob_get_clean();
    }

    function ihewc_oxi_VC_extension() {
        global $wpdb;
        $data = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'image_hover_with_carousel_style ORDER BY id DESC', ARRAY_A);
        $vcdata = array();
        foreach ($data as $value) {
            $vcdata[] = $value['id'];
        }
        vc_map(array(
            "name" => __("Image Hover with Carousel"),
            "base" => "ihewc_oxi_VC",
            "category" => __("Content"),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => "Image Hover Select",
                    "param_name" => "id",
                    "value" => $vcdata,
                    'save_always' => true,
                    "description" => "Select your Image Hover ID",
                    "group" => 'Settings',
                ),
            )
        ));
    }

}

function ihewc_promote_free() {
    ?>

    <div class="ctu-admin-wrapper-promote">
        <div class="col-lg-5 col-md-5 hidden-sm hidden-xs">
            <h1>Image Hover Effects with <span>Carousel</span></h1>
            <p>If you have any difficulties in using the options, please follow the link to <a href="https://www.oxilab.org/docs/image-hover-with-carousel/getting-started/installing-for-the-first-time/">Documentation</a> </p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xm-12">
            <p><a target="_blank" href="https://www.oxilab.org/downloads/image-hover-with-carousel/" class="ctu-admin-wrapper-promote-botton"><i class="fa fa-cart-plus" aria-hidden="true"></i> Upgrade NOW </a> <br> Just click on "Upgrade NOW" to get Pro Version only $10.99.</p>
        </div>
        <div class="col-lg-3 col-md-3  hidden-sm hidden-xs ctu-admin-wrapper-promote-rate">
            <p> <i class="fa fa-heart" aria-hidden="true"></i>  <a target="_blank" href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel/reviews/">Rate Us</a></p>
            <p> <i class="fa fa-life-ring" aria-hidden="true"></i>  <a target="_blank" href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel/">Support Ticket</a></p>
            <p> <i class="fa fa-envelope" aria-hidden="true"></i>  <a target="_blank" href="https://www.oxilab.org/contact-us/">Contact Oxilab</a></p>
            <p> <i class="fa fa-youtube" aria-hidden="true"></i> <a target="_blank" href="https://youtu.be/44L2Q6ahOtI">Video Tutorials</a></p>
        </div>
    </div>
    <?php
}

add_action('admin_init', 'Ihewc_image_hover_welcome_activation_redirect');

function Ihewc_image_hover_welcome_activation_redirect() {
    if (!get_transient('_Ihewc_image_hover_welcome_activation_redirect')) {
        return;
    }
    delete_transient('_Ihewc_image_hover_welcome_activation_redirect');
    if (is_network_admin() || isset($_GET['activate-multi'])) {
        return;
    }
    wp_safe_redirect(add_query_arg(array('page' => 'Ihewc-image-hover-effects-welcome'), admin_url('index.php')));
}
add_action('admin_menu', 'ihewc_image_hover_welcome_pages');

function ihewc_image_hover_welcome_pages() {
    add_dashboard_page(
            'Welcome To Image Hover Effects with Carousel', 'Welcome To Image Hover Effects with Carousel', 'read', 'Ihewc-image-hover-effects-welcome', 'ihewc_image_hover_effects_welcome'
    );
}

function ihewc_image_hover_effects_welcome() {
    wp_enqueue_style('ihewc-image-welcome-style', plugins_url('css-js/admin-welcome.css', __FILE__));
    ?>
    <div class="wrap about-wrap">

        <h1>Welcome to Image Hover Effects with Carousel</h1>
        <div class="about-text">
            Thank you for choosing image Hover Effects with Carousel - the most friendly WordPress Image Hover plugin. Here's how to get started.
        </div>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active">
                Getting Started		
            </a>
        </h2>
        <p class="about-description">
            Use the tips below to get started using Image Hover Effects Ultimate. You will be up and running in no time.	
        </p>
        <div class="feature-section">
            <h3>Creating Your First Hover Effects</h3>
            <p>Image Hover Effects makes it easy to create Hover Effects in WordPress. You can follow the video tutorial on the right or read our how to 
                <a href="https://www.oxilab.org/docs/image-hover-with-carousel/getting-started/installing-for-the-first-time/" target="_blank" rel="noopener">create your first Hover effects guide</a>.					</p>
            <p>But in reality, the process is so intuitive that you can just start by going to <a href="<?php echo admin_url();?>admin.php?page=image-hover-carousel-new">Image Hover - &gt; New Effects</a>.				</p>
            </br>
            </br>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/44L2Q6ahOtI" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="feature-section">
            <h3>See all Image Hover Effects with Carousel Features</h3>
            <p>Image Hover Effects with Carousel is both easy to use and extremely powerful. We have tons of helpful features that allows us to give you everything you need on Image Hover Effects.</p>
            <p>1. Awesome Live Preview Panel</p>
            <p>1. Can Customize with Our Settings</p>
            <p>1. Easy to USE & Builtin Integration for popular Page Builder</p>
            <p><a href="https://www.oxilab.org/downloads/image-hover-with-carousel/" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">See all Features</a></p>

        </div>
        <div class="feature-section">
            <h3>Have any Bugs or Suggestion</h3>
            <p>Your suggestions will make this plugin even better, Even if you get any bugs on Image Hover Effects with Carousel so let us to know, We will try to solved within few hours</p>
            <p><a href="https://www.oxilab.org/contact-us" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Contact Us</a>
                <a href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Support Forum</a></p>

        </div>

    </div>
    <?php
}

add_action('admin_head', 'ihewc_image_hover_welcome_screen_remove_menus');

function ihewc_image_hover_welcome_screen_remove_menus() {
    remove_submenu_page('index.php', 'Ihewc-image-hover-effects-welcome');
}