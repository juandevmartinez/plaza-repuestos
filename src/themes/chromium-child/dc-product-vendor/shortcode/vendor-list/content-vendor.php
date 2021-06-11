<?php

/**
 * Vendor List Map
 *
 * This template can be overridden by copying it to yourtheme/dc-product-vendor/shortcode/vendor-list/content-vendor.php
 *
 * @package WCMp/Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $WCMp, $vendor_list;
$vendor = get_wcmp_vendor($vendor_id);
$image = $vendor->get_image() ? $vendor->get_image('image', array(150, 150)) : $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
$rating_info = wcmp_get_vendor_review_info($vendor->term_id);
$rating = round($rating_info['avg_rating'], 2);
$formatted_address = $vendor->get_formatted_address() ? substr($vendor->get_formatted_address(), 0, 20) : __('No Address found', 'dc-woocommerce-multi-vendor');
$review_count = empty(intval($rating_info['total_rating'])) ? '' : intval($rating_info['total_rating']);
$vendor_phone = $vendor->phone ? $vendor->phone : __('No number yet', 'dc-woocommerce-multi-vendor');
$banner = $vendor->get_image('banner') ? $vendor->get_image('banner') : false;
$permalink = $vendor->get_permalink();
$vendor_name = esc_html($vendor->page_title);
$products = $vendor->get_products() ? $vendor->get_products( array( 'posts_per_page' => 3 ) ) : false;

?>
<div class="wcmp-store-list wcmp-store-list-vendor">
    <div class="card">
        <div class="card-banner">
            <?php if( $banner ): ?>
                <img src="<?php echo $banner ?>" alt="banner">
            <?php endif; ?>
        </div>
        <div class="card-profile-pic">
            <a href="<?php echo $permalink; ?>"><img src="<?php echo $image ?>" alt="profile-pic"></a>
        </div>
        <div class="card-information">
            <a href="<?php echo $permalink; ?>" class="vendor-name"><?php echo $vendor_name ?></a>
            <p class="vendor-address"> <?php echo $formatted_address ?>... </p>
        </div>
        <div class="card-products">
            <?php if( $products ): ?>
                <?php foreach( $products as $post ):
                    $product = wc_get_product( $post->ID );
                    $image = $product->get_image();
                    $product_link = get_permalink( $post->ID ); 
                ?>

                    <a href="<?php echo $product_link; ?>"><?php echo $image; ?></a>
                <?php endforeach ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>

</style>