<?php
/**
 * @package Chromium Child
 * The parent theme functions are located at /chromium/inc/theme-functions.php
 * Add your own functions at the bottom of this file.
 */


/****************************** THEME SETUP ******************************/


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

 function add_meta_user_registration( $user_id ){
    $user = get_userdata ( $user_id );
    // Update the registration meta data
    update_user_meta ( $user_id, 'registration_date', $user->user_registered );
 }
 add_action('user_register', 'add_meta_user_registration' , 10, 1);

 function get_approved_date( $user_id ){
   return get_user_meta( $user_id, 'approved_date', true );
 };

 function update_meta_on_change( $user_id, $role, $old_roles ){

   switch( $role ){
      case 'dc_vendor':
         register_approved_date( $user_id );
         break;  
   }

 }
 add_action( 'set_user_role', 'update_meta_on_change', 10, 3 );

 function var_view( $data ){
    echo '<pre>' . var_dump( $data ) . '</pre>';
 }

 function register_approved_date( $user_id ){
      $date = strtotime("now");
      return update_user_meta( $user_id, 'approved_date', $date  );
 }


 /**
  * Remove External Products 
  */
 add_filter( 'product_type_selector', 'remove_product_types' );
 function remove_product_types( $types ){
   unset( $types['external'] );
   return $types;
 }