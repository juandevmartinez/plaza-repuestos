<?php

/*
 * The template for displaying vendor stats reports dashboard widget
 * Override this template by copying it to yourtheme/dc-product-vendor/vendor-dashboard/dashboard-widgets/wcmp_vendor_stats_reports.php
 *
 * @author 	WC Marketplace
 * @package 	WCMp/Templates
 * @version   3.0.0
 */
if (!defined('ABSPATH')) {
    // Exit if accessed directly
    exit;
}
global $WCMp;

do_action('before_wcmp_vendor_stats_reports'); 
?>
<div class="pannel panel-default pannel-outer-heading staticstics-panel-wrap">
    <div class="panel-body">
        <h2><i class="wcmp-font ico-report-icon"></i> <?php printf( __( 'Your Store Report - %s', 'dc-woocommerce-multi-vendor' ), '<span class="_wcmp_stats_period"></span>' );?></h2>
        <div class="row">
            <div class="col-md-4 key-perfomence-indicator">
                <h2><?php _e('Key Performance Indicators', 'dc-woocommerce-multi-vendor'); ?></h2>
                <ul class="short-stat-info-list">
                    <li>
                        <span class="stat-icon" title="<?php _e('Traffic', 'dc-woocommerce-multi-vendor'); ?>"><i class="wcmp-font ico-visit-icon"></i></span>
                        <span class="_wcmp_stats_table current_traffic_no current-stat-report"></span>
                        <span class="_wcmp_stats_table previous_traffic_no prev-stat-report"></span>
                    </li>
                    <li>
                        <span class="stat-icon" title="<?php _e('Order No', 'dc-woocommerce-multi-vendor'); ?>"><i class="wcmp-font ico-cart-icon"></i></span>
                        <span class="_wcmp_stats_table current_orders_no current-stat-report"></span>
                        <span class="_wcmp_stats_table previous_orders_no prev-stat-report"></span>
                    </li>
                    <li>
                        <span class="stat-icon" title="<?php _e('Sales', 'dc-woocommerce-multi-vendor'); ?>"><i class="wcmp-font ico-price2-icon"></i></span>
                        <span class="_wcmp_stats_table current_sales_total current-stat-report"></span>
                        <span class="_wcmp_stats_table previous_sales_total prev-stat-report"></span>
                    </li>
                </ul>
                <ul class="short-stat-info-list">
                    <li>
                        <span class="stat-icon" title="<?php _e('Earning', 'dc-woocommerce-multi-vendor'); ?>"><i class="wcmp-font ico-earning-icon"></i></span>
                        <span class="_wcmp_stats_table current_earning current-stat-report"></span>
                        <span class="_wcmp_stats_table previous_earning prev-stat-report"></span>
                    </li>
                    <li>
                        <span class="stat-icon" title="<?php _e('Withdrawal', 'dc-woocommerce-multi-vendor'); ?>"><i class="wcmp-font ico-revenue-icon"></i></span>
                        <span class="_wcmp_stats_table current_withdrawal current-stat-report"></span>
                        <span class="_wcmp_stats_table previous_withdrawal prev-stat-report"></span>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                <h2><?php _e('Store Insights', 'dc-woocommerce-multi-vendor'); ?></h2>
                <p class="stat-detail-info"><span><i class="wcmp-font ico-avarage-order-value-icon"></i></span> <?php printf( __( 'Your average order value %1$s for this span was %2$s', 'dc-woocommerce-multi-vendor' ), '<strong>(AOV)</strong>', '<span class="_wcmp_stats_aov stats-aov"></span>'); ?> </p>
                <p class="stat-detail-info"><span><i class="wcmp-font ico-revenue-icon"></i></span> <?php printf( __( 'During this span, %1$s has been credited to your %2$s account, as commission.', 'dc-woocommerce-multi-vendor' ), '<mark class="_wcmp_stats_table current_withdrawal withdrawal-label mark-green"></mark>', $payment_mode); ?></p>
                <div class="compare-stat-info">
                    <span><b><?php _e('Compare your store performance against', 'dc-woocommerce-multi-vendor'); ?></b></span>
                    <select name="" id="wcmp_vendor_stats_report_filter" class="form-control" data-stats="<?php echo htmlspecialchars(wp_json_encode($vendor_report_data)); ?>">
                        <?php 
                        if($stats_reports_periods){
                            foreach ($stats_reports_periods as $key => $value) {
                                echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <ul class="wcmp-website-stat-list">
                    <li>
                        <span><i class="wcmp-font ico-visit-icon"></i></span>
                        <span><?php _e('Store traffic', 'dc-woocommerce-multi-vendor'); ?> <mark id="stats-diff-traffic" class="_wcmp_diff_traffic_no "></mark></span>
                    </li>
                    <li>
                        <span><i class="wcmp-font ico-cart-icon"></i></span>
                        <span><?php _e('Received orders', 'dc-woocommerce-multi-vendor'); ?> <mark id="stats-diff-order-no" class="_wcmp_diff_orders_no "></mark></span>
                    </li> 
                    <li>
                        <span><i class="wcmp-font ico-price2-icon"></i></span>
                        <span><?php _e('Total sales', 'dc-woocommerce-multi-vendor'); ?> <mark id="stats-diff-sales-total" class="_wcmp_diff_sales_total "></mark></span>
                    </li>
                    
                    <li>
                        <span><i class="wcmp-font ico-earning-icon"></i></span>
                        <span><?php _e('Your earning', 'dc-woocommerce-multi-vendor'); ?> <mark id="stats-diff-earning" class="_wcmp_diff_earning "></mark></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
do_action('after_wcmp_vendor_stats_reports');
