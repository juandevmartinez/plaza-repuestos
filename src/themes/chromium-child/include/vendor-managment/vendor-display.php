<?php 
/**
 * Adding a custom column to vendors display
 */
add_filter('wcmp_list_table_vendors_columns', 'date_of_rent', 10,1);
function date_of_rent( $columns ){
   $columns = [
      'cb' => '<input type="checkbox" />',
      'username' => __( 'Name', 'dc-woocommerce-multi-vendor' ),
      'email' => __( 'Email', 'dc-woocommerce-multi-vendor' ),
      'registered' => __( 'Registered', 'dc-woocommerce-multi-vendor' ),
      'products' => __( 'Products', 'dc-woocommerce-multi-vendor' ),
      'status' => __( 'Status', 'dc-woocommerce-multi-vendor' ),
      'active_rent' => __( 'Fecha Activa', 'dc-woocommerce-multi-vendor' ),
      'rent' => __( 'Fecha de Cobro', 'dc-woocommerce-multi-vendor' ),
  ];
  return $columns;
}

/**
 * Inserting Corresponding data for columns
 */
add_filter('wcmp_list_table_vendors_columns_data','vendor_data',10,1);
function vendor_data($user){
    $user = array(
                    'ID' => $user['ID'],
                    'name' => $user['name'],
                    'rent'=> get_payment_date($user['ID']),
                    'active_rent'=> get_approved_date($user['ID']),
                    'email' => $user['email'],
                    'registered' => get_date_from_gmt( $user['registered'], 'd-m-Y' ),
                    'products' => $user['products'],
                    'status' => $user['status'],
                    'permalink' => $user['permalink'],
                    'username' => $user['name']
                    );                
    return $user;
}

/**
 * Get store name
 */
function get_vendor_store_name( $user_id ){
    $name = get_user_meta( $user_id, '_vendor_page_title', true );
    return $name;
}