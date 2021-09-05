<?php

/**
 * Insert register date to the user
* @param int ($user_id) ID of the user
* @return bool
*/
function register_approved_date( $user_id ){
    $date = current_time( 'mysql' );
    return update_user_meta( $user_id, 'approved_date', $date );
}


/**
 * Update metadata from user depending of the new role
* @param int ($user_id) ID of the user
* @param string ($role) New Role
* @param array ($old_roles) Old roles
* @return bool Status of update
*/
function update_meta_on_change( $user_id, $role, $old_roles ){
    switch( $role ){
        case 'dc_vendor':
            var_view($user_id);
            register_approved_date( $user_id );
            return true;
            break;  
    }
}
 add_action( 'wcmp_set_user_role', 'update_meta_on_change', 10, 3 );


/**
 * Get Approved date from user
* @param int ID of the user
* @return date The approved date of register  
*/
function get_approved_date( $user_id ){
    $date_string = get_user_meta( $user_id, 'approved_date', true );
    //Exit the function if empty
    if ( empty($date_string) )
        return null;

    $date = date( "d-m-Y", strtotime($date_string) );
    return $date;
};

/**
 * Get Payment Date
 * @param string Date String
 * @return string Date Formatted 
 */
function get_payment_date( $user_id ){
    $approved_date = get_approved_date( $user_id );
    $time = get_user_meta( $user_id, 'payment_date_period', true);
    $payment_date = date("d-m-Y", strtotime( $time, strtotime($approved_date) )); 

    //Exit the function if empty
    if( empty($approved_date) )
        return null;
    
    if( is_admin() && $payment_date < $approved_date && $GLOBALS['pagenow'] === 'admin.php' ){
        return 'inactiva';
    }

    return $payment_date;
}

/**
 * Update rent payment as a subscription
 * @param order_id ID of the Woocommerce Order
 * @return bool
 */
function update_payment_date_by_subscription( $order_id ){
    // get order object and items
    $order = wc_get_order( $order_id );
    $items = $order->get_items();
    $userID = $order->get_user_id();
    

    // Products to check in order 
    $products_to_check = array( 4058, 4060 );

    foreach ( $items as $item ) {
        $productID = $item->get_product_id();
        if ( $userID > 0 && in_array( $productID, $products_to_check ) ) {
            $user = new WP_User( $userID );

            $user_status = get_current_status( $user->ID );
            if( $user_status == 'expired' ){
                register_approved_date( $user->ID );
            }
            // Set Role and remove old one
            $user->set_role( 'dc_vendor' );
            update_user_meta( $user->ID, 'payment_date_period', get_post_meta( $item['product_id'], 'rent_period', true ));
            if( get_user_meta( $user->ID, '_vendor_turn_off', true ) ){
                delete_user_meta( $user->ID, 'vendor_turn_off');
            }
            return true; 
        }
    }
    return false;
}
add_action( 'woocommerce_order_status_completed', 'update_payment_date_by_subscription' );
