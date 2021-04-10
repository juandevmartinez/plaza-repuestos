<?php

function widget_vendors_slider(){
        /**
     * Query users by roles
     */
    $args = array(
        'role'      =>  'dc_vendor',
        'orderby'   =>  'user_nicename',
        'order'     =>  'ASC'
    );
    $users = get_users( $args );
    ob_start();
    ?>
    <div role="tabpanel" class="tab-pane fade in active row" data-owl="container" data-owl-margin="30" data-owl-slides="3" data-owl-loop="true" data-owl-col-mobile="1" data-owl-slide-by="1">
        <span class="carousel-loader"></span>
        <div class="slider-navi"><span class="prev"></span><span class="next"></span></div>
        <div class="woocommerce columns-3">
            <ul class="products columns-3">
                <?php foreach( $users as $user ):
                        $vendor = get_wcmp_vendor($user->ID);
                        $image = $vendor->get_image() ? $vendor->get_image('image', array(125, 125)) : $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
                        $address = $vendor->get_formatted_address();
                        $permalink = $vendor->get_permalink();  
                        $shop_name = get_user_meta( $user->ID,'_vendor_page_title', true );
                    ?>
                <li class="product type-product">
                    <div class="inner-wrapper">
                        <div class="img-wrapper">
                            <a href="<?php echo $permalink; ?>">
                                <img src="<?php echo $image; ?>>" alt="vendor-img">
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
    <?php

    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_shortcode('widget_vendors_slider', 'widget_vendors_slider');