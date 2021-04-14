<?php

function create_custom_admin_role(){
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    $adm = $wp_roles->get_role('administrator');
    //Adding a 'new_role' with all admin caps
    $wp_roles->add_role('plaza_administrator', 'Administrador Plaza', $adm->capabilities);
}
add_action( 'init', 'create_custom_admin_role' );

function remove_menus(){

    $menus = array(
        'elementor', 
        'edit.php?post_type=elementor_library&tabs_group=library', 
        'wp-mail-catcher', 
        'maxmegamenu', 
        'dgwt_wcas_settings',
        'plugins.php'
    );
    foreach ( $menus as $menu ){
        remove_menu_page( $menu );
    }

}

function remove_sub_menus(){

    global $menu, $submenu;
    $sub_menus = array(
        'woocommerce'   =>  6,
        'woocommerce'   =>  7,
        'woocommerce'   =>  4,
        'wcmp'          =>  1,
        'wcmp'          =>  2,
        'wcmp'          =>  6,
        'themes.php'    =>  12,
        'themes.php'    =>  14,
    );

    foreach( $sub_menus as $key => $value){
        unset( $submenu[$key][$value] );
    }
}


/**
 * Create the custom dashboard for plaza_administrator
 */
function custom_dashboard(){
    //Checking if we are on the dashboard area
    if( is_admin() && is_user_logged_in() ){
        $user = wp_get_current_user();
        if( in_array('plaza_administrator', (array) $user->roles) ){
            remove_menus();
            remove_sub_menus();
        }
    }
}
add_action('admin_menu', 'custom_dashboard', 999);