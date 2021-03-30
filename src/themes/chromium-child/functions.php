<?php
/**
 * @package Chromium Child
 * The parent theme functions are located at /chromium/inc/theme-functions.php
 * Add your own functions at the bottom of this file.
 */

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Chromium 1.0.0
 */

 function chromium_child_enqueue(){

    /**
     * Enqueing Parent styles for child theme
     */
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get('Version'));
 }
 add_action('wp_enqueue_scripts', 'chromium_child_enqueue');

 /**
  * Calling custom logic
  */
  require_once( __DIR__ . '/include/vendor-managment/vendor-display.php' );
  require_once( __DIR__ . '/include/vendor-managment/registration-management.php' );
  require_once( __DIR__ . '/include/woocommerce/custom-functions.php' );
  require_once( __DIR__ . '/include/vendor-managment/check-vendor-status.php' );
  require_once(__DIR__ . '/include/woocommerce/include/custom-tab-woocommerce.php');

 function var_view( $data ){
    echo '<pre>' . var_dump( $data ) . '</pre>';
 }
