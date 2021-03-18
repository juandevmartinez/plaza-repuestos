<?php 

/**
 * Remove External Products 
*/
add_filter( 'product_type_selector', 'remove_product_types' );
function remove_product_types( $types ){
    unset( $types['external'] );
    return $types;
}