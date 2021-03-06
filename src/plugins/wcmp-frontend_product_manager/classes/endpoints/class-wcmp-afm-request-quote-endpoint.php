<?php
/**
 * WCMp_AFM_Request_Quote_Endpoint setup
 *
 * @package  WCMp_AFM/classes/endpoints
 * @since    3.0.0
 */
defined( 'ABSPATH' ) || exit;

class WCMp_AFM_Request_Quote_Endpoint {
    public function output( ) {
        $current_vendor_id = afm()->vendor_id;

        if ( ! $current_vendor_id || ! apply_filters( 'vendor_can_access_request_quote', true, $current_vendor_id ) ) {
            ?>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <?php esc_html_e( 'You do not have permission to view this content. Please contact site administrator.', 'wcmp-afm' ); ?>
                </div>
            </div>
            <?php
            return;
        }
        
        $rental_quote_params = array(
            'ajax_url'     => admin_url( 'admin-ajax.php' ),
            'empty_table'  => esc_js( __( 'No quotes found!', 'wcmp-afm' ) ),
            'processing'   => esc_js( __( 'Processing...', 'wcmp-afm' ) ),
            'info'         => esc_js( __( 'Showing _START_ to _END_ of _TOTAL_ quotes', 'wcmp-afm' ) ),
            'info_empty'   => esc_js( __( 'Showing 0 to 0 of 0 quotes', 'wcmp-afm' ) ),
            'length_menu'  => esc_js( __( 'Number of rows _MENU_', 'wcmp-afm' ) ),
            'zero_records' => esc_js( __( 'No matching quotes found', 'wcmp-afm' ) ),
            'next'         => esc_js( __( 'Next', 'wcmp-afm' ) ),
            'previous'     => esc_js( __( 'Previous', 'wcmp-afm' ) ),
            'reload'       => esc_js( __( 'Reload', 'wcmp-afm' ) ),
        );
        wp_localize_script( 'afm-rental-quotes-js', 'rental_quote_params', $rental_quote_params );
        wp_enqueue_script( 'afm-rental-quotes-js' );
        
        afm()->template->get_template('products/rental/html-endpoint-request-quote.php');
    }
}

