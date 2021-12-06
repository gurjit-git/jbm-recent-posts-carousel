<?php
/*
Plugin Name: JBM Recent Posts Carousel
Plugin URI: http://wordpress.org/
Description: This is a carousel plugin
Author: Gurjit Singh
Version: 1.0
Author URI: http://gurjitsingh.com
*/
defined( 'ABSPATH' ) or die( 'Direct access not allowed!' );
define( 'JBM_INSTAGRAM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

function jbm_include_css_js(){
   // wp_enqueue_style( 'docs-theme-style', plugins_url('/assets/css/docs.theme.min.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_style( 'owl-carousel-style', plugins_url('/assets/owlcarousel/assets/owl.carousel.min.css', __FILE__), false, '1.0.0', 'all');
	wp_enqueue_style( 'owl-theme-default-style', plugins_url('/assets/owlcarousel/assets/owl.theme.default.min.css', __FILE__), false, '1.0.0', 'all');

	wp_enqueue_script( 'jbm-newscript', plugins_url( '/assets/vendors/jquery.min.js' , __FILE__ ), array( 'jquery' ), '1.0.0', true  );
	wp_enqueue_script( 'owl-carousel-script', plugins_url( '/assets/owlcarousel/owl.carousel.js' , __FILE__ ), array( 'jquery' ), '1.0.0', true  );
	
	wp_enqueue_script( 'jbm-custom-script', plugins_url( '/assets/js/custom.js' , __FILE__ ), array( 'jquery' ), '1.0.0', true  );
	
	wp_enqueue_script( 'highlight-script', plugins_url( '/assets/vendors/highlight.js' , __FILE__ ), array( 'jquery' ), '1.0.0', true  );
	wp_enqueue_script( 'app-script', plugins_url( '/assets/js/app.js' , __FILE__ ), array( 'jquery' ), '1.0.0', true  );
	
}
add_action('wp_enqueue_scripts', "jbm_include_css_js");

function jbm_load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', plugins_url('/assets/css/admin/custom.css', __FILE__), false, '1.0.0', 'all' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'jbm_load_custom_wp_admin_style' );

include('carousel-post-type.php');
include('cmb-functions.php');
include('carousel-shortcode.php');
add_shortcode('jbm_carousel_shortcode','jbm_carousel_shortcode');

?>
