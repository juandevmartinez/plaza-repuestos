<?php 
/**
 * Check Vendor status for rent payment
 */

/**
 * Current Status of user
 * @param int $user_id ID of the user
 * @return string Status of the current User
 */
 function get_current_status( $user_id ){
    $payment_date = new DateTime(get_payment_date( $user_id ));
    $today = new DateTime();
    $status = $today > $payment_date ? 'expired' : 'approved';
    return $status;
 }

 /**
  * Change role of user if their status is expired
  * @param int $user_id ID of the user
  * @return bool
  */
 function change_role_for_expired_users( $user_id ){
    $status = get_current_status( $user_id );
    $user_data = get_userdata( $user_id );
    $user = new WP_USer( $user_id );
    $roles = $user_data->roles;
    $is_vendor = is_user_wcmp_vendor( $user_object );
    $pending_vendor_role = 'dc_pending_vendor';

    if ( $status === 'expired' && $is_vendor ){
        $user_object->set_role( $pending_vendor_role );
        return true;
    }

    return false;
 }

 /**
  * Suspend vendor
  */
  function suspend_vendor( $user_id ){
    $user = new WP_User( $user_id );
    if( is_user_wcmp_vendor( $user ) ){
        update_user_meta($user_id, '_vendor_turn_off', 'Enable');
    }
  }