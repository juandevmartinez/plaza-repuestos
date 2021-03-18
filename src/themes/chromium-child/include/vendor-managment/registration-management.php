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
        return;

    $date = date( "d-m-Y", strtotime($date_string) );
    return $date;
};

/**
 * Get Payment Date
 * @param string Date String
 * @return string Date Formatted with 1+ month as the payment
 */
function get_payment_date( $user_id ){
    $approved_date = get_approved_date( $user_id );

    //Exit the function if empty
    if( empty($approved_date) )
        return;

    $payment_date = date("d-m-Y", strtotime( "+1 month", strtotime($approved_date) )); 
    return $payment_date;
} 