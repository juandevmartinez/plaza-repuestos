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

    //Custom css
    wp_enqueue_style( 'custom-styles', get_stylesheet_directory_uri() . '/dist/css/style.css') ;
    //Custom JS
    wp_enqueue_script( 'global-custom', get_stylesheet_directory_uri() . '/dist/js/global.js', array('jquery') );

 }
 add_action('wp_enqueue_scripts', 'chromium_child_enqueue');

 /**
  * Changing Colors for setup vendor page
  */
 function woocommerce_vendor_styles(){
   wp_enqueue_style('wc-setup-custom', get_stylesheet_directory_uri(). '/dist/css/woocommerce.css');
 }
 add_action('admin_print_styles', 'woocommerce_vendor_styles');
 /**
  * Adding styles for wcmp
  */
  function custom_styles_wcmp(){
  }
  add_action('wcmp_init', 'custom_styles_wcmp');
/**
 * Adding custom admin color scheme
 */
 function plaza_admin_color_scheme() {
   //Get the theme directory
   $theme_dir = get_stylesheet_directory_uri();
  
   //Plaza
   wp_admin_css_color( 'plaza', __( 'Plaza' ),
     $theme_dir . '/dist/css/plaza.css',
     array( '#23282d', '#fff', '#d54e21' , '#fdb819')
   );
 }
 add_action('admin_init', 'plaza_admin_color_scheme');
 
 /**
  * Enqueing select2 for admin page
  */
  function add_select2_to_admin(){
    wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ));
    wp_enqueue_script('vendors_select2', get_stylesheet_directory_uri() . '/dist/js/select2-vendors.js', array( 'jquery' , 'select2' ));
  }
  add_action('admin_enqueue_scripts', 'add_select2_to_admin' );

 /**
  * Calling custom logic
  */
  require_once( __DIR__ . '/include/vendor-managment/vendor-display.php' );
  require_once(__DIR__ . '/include/custom-slider-options.php');
  require_once( __DIR__ . '/include/vendor-managment/registration-management.php' );
  require_once( __DIR__ . '/include/woocommerce/custom-functions.php' );
  require_once( __DIR__ . '/include/vendor-managment/check-vendor-status.php' );
  require_once(__DIR__ . '/include/woocommerce/include/custom-tab-woocommerce.php');
  require_once(__DIR__ . '/include/woocommerce/shortcodes/rent_form.php');
  require_once(__DIR__ . '/shortcodes/woocommerce/vendors.php');
  require_once(__DIR__ . '/shortcodes/woocommerce/widget_vendors.php');
  require_once(__DIR__ . '/include/custom-dashboard.php');
  
 function var_view( $data ){
    echo '<pre>' . var_export($data, true) . '</pre>';
 }

 function get_vendors_for_slider(){
   $slides = get_slides_from_slider();
   $ids = [];
   foreach( $slides as $index => $slide ){
      $ids[] = get_option( 'vendor_slider_' . $index );
   }
   return $ids;
 }


 /**
  * Hide unwanted columns in woocommerce product view
  */
add_filter( 'manage_edit-product_columns', 'change_columns_filter',10, 1 );
function change_columns_filter( $columns ) {
  unset($columns['product_tag']);
  unset($columns['taxonomy-dc_vendor_shop']);
  unset($columns['wcmp_product_gtin']);
  unset($columns['wpseo-score']);
  unset($columns['wpseo-score-readability']);
  unset($columns['wpseo-title']);
  unset($columns['wpseo-metadesc']);
  unset($columns['wpseo-focuskw']);
  unset($columns['comments']);
  return $columns;
}
 
 