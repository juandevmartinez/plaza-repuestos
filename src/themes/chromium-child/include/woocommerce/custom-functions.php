<?php 

/**
 * Remove External Products 
*/
add_filter( 'product_type_selector', 'remove_product_types' );
function remove_product_types( $types ){
    unset( $types['external'] );
    return $types;
}

/**
 * Hide Product Categories from targeted pages in WooCommerce
 * @link https://gist.github.com/stuartduff/bd149e81d80291a16d4d3968e68eb9f8#file-wc-exclude-product-category-from-shop-page-php
 *
 */
function prefix_custom_pre_get_posts_query( $q ) {
    
    if( is_shop() || is_woocommerce() ) { // set conditions here
        
        $tax_query = (array) $q->get( 'tax_query' );
        
        $tax_query[] = array(
            'taxonomy' => 'uncategorized',
            'field' => 'slug',
            'operator' => 'NOT IN'
        );
        
        $q->set( 'tax_query', $tax_query );
    }       
}
add_action( 'woocommerce_product_query', 'prefix_custom_pre_get_posts_query' );
