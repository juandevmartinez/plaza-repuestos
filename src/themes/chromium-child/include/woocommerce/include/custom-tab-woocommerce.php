<?php


/**
 * Adding custom tab
 * @param tabs From the woocommerce tabs
 * @return tabs New Added tabs
 */
function misha_product_settings_tabs( $tabs ){
    
    
    $tabs['misha'] = array(
        'label'    => 'Arriendo',
		'target'   => 'misha_product_data',
		'class'    => array('show_if_virtual'),
		'priority' => 21,
	);
	return $tabs;
    
}
add_filter('woocommerce_product_data_tabs', 'misha_product_settings_tabs' );

/**
 * Adding html element
 * @return element HTML element to be added on the custom tab
 */
function misha_adv_product_options(){

    echo '<div id="misha_product_data" class="panel woocommerce_options_panel hidden">';

    woocommerce_wp_select( array(
		'id'          => 'rent_period',
		'value'       => get_post_meta( get_the_ID(), 'rent_period', true ),
		'wrapper_class' => 'show_if_virtual',
		'label'       => 'Tiempo de arriendo',
		'options'     => array( 
            '' => 'Seleccione el tiempo a pagar', 
            '+1 month' => '1 mes', 
            '+6 month' => '6 meses', 
            '+1 year' => '1 año'),
	) );
 
    echo '</div>';
}
add_action( 'woocommerce_product_data_panels', 'misha_adv_product_options');
 
 
/**
 * Saving fields to database
 * @return bool 
 */
function misha_save_fields( $id, $post ){
 
	if( !empty( $_POST['rent_period'] ) ) {
		update_post_meta( $id, 'rent_period', $_POST['rent_period'] );
        return true;
	} else {
		delete_post_meta( $id, 'rent_period' );
        return false;
	}
 
}
add_action( 'woocommerce_process_product_meta', 'misha_save_fields', 10, 2 );
