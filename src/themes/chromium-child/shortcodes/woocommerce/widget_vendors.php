<?php
/**
 * Query users by roles
 */
$args = array(
    'role'      =>  'dc_vendor',
    'orderby'   =>  'user_nicename',
    'order'     =>  'ASC'
);
$users = get_users( $args );

foreach( $users as $user ){
    $vendor = get_wcmp_vendor($user->ID);
    $image = $vendor->get_image() ? $vendor->get_image('image', array(125, 125)) : $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
    $address = $vendor->get_formatted_address();
    $permalink = $vendor->get_permalink();  
    $shop_name = get_user_meta( $user->ID,'_vendor_page_title', true );
}