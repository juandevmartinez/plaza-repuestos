<?php

function widget_vendors_slider(){
        /**
     * Query users by roles
     */
    global $WCMp;
    $args = array(
        'role'      =>  'dc_vendor',
        'orderby'   =>  'user_nicename',
        'order'     =>  'ASC'
    );
    $users = get_users( $args );
    ob_start();
    ?>
    <div class="tab-nav-wrapper">
        <div class="title-wrapper">
            <h3 class="shortcode-title">
                <span>Nuestros</span> Locales
            </h3>
        </div>
    </div>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active row" data-owl="container" data-owl-margin="30" data-owl-slides="3" data-owl-loop="true" data-owl-col-mobile="1" data-owl-slide-by="1">
            <span class="carousel-loader"></span>
            <div class="slider-navi"><span class="prev"></span><span class="next"></span></div>
            <div class="woocommerce columns-3">
                <ul class="products columns-3">
                    <?php foreach( $users as $user ):
                            $vendor = get_wcmp_vendor($user->ID);
                            /**
                             * We are substracting one to get the full image
                             */
                            $image = is_numeric($vendor->image) ? wp_get_attachment_image_src($vendor->image - 1, 'large')[0] : $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
                            $address = $vendor->get_formatted_address();
                            $permalink = $vendor->get_permalink();  
                            $shop_name = get_user_meta( $user->ID,'_vendor_page_title', true );
                        ?>
                    <li class="product type-product type-vendor-slide">
                        <div class="inner-wrapper vendor-inner-wrapper">
                            <div class="img-wrapper">
                                <a href="<?php echo $permalink; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                    <img src="<?php echo $image; ?>" alt="vendor-img" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail vendor-profile-tab-image">
                                </a>
                            </div>
                            <div class="excerpt-wrapper">
                                <p class="primary-cat address"><?php echo $address; ?></p>
                                <a href="<?php echo $permalink; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                <h2 class="woocommerce-loop-product__title"> <?php echo $shop_name; ?></h2>
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <?php

    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_shortcode('widget_vendors_slider', 'widget_vendors_slider');