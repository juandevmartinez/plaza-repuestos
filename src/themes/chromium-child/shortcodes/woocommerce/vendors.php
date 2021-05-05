<?php
function shops_slider_connection(){
    global $WCMp;
    $vendors = get_vendors_for_slider();
    ob_start();
    ?>
        <div class="container-vendors">
            <div class="vendors">
            <?php if( !empty( $vendors ) ):?>
                <?php foreach( $vendors as $index => $array ):?>
                    <div class="vendors-slider flex-container hide" data-slide-vendors="<?php echo ($index + 1); ?>">
                        <div class="product type-product">
                        <?php foreach( $array as $user ):
                            $vendor = get_wcmp_vendor( $user );
                            $image = is_numeric($vendor->image) ? wp_get_attachment_image_src($vendor->image - 1, 'large')[0] : $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
                            $address = $vendor->get_formatted_address();
                            $permalink = $vendor->get_permalink();  
                            $shop_name = get_user_meta( $user,'_vendor_page_title', true );
                        ?>
                            <div class="inner-wrapper">
                                <div class="img-wrapper">
                                    <a href="<?php echo $permalink; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><img width="210" height="210" src="<?php echo $image;?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" loading="lazy"></a>
                                    <div class="buttons-wrapper"><span class="product-tooltip" style="display: none;"></span></div>
                                </div>
                                <div class="excerpt-wrapper">
                                    <a href="<?php echo $permalink; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                        <p class="address"><?php echo $address; ?></p>
                                        <h2 class="woocommerce-loop-product__title"><?php echo $shop_name; ?></h2>
                                    </a>
                                    <div class="price-wrapper">
                                        <a href="<?php echo $permalink; ?>" class="button product_type_simple" rel="nofollow">Ver local</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                      
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_shortcode('shops_slider_connection', 'shops_slider_connection');