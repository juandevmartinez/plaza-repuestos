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
                    <div class="vendors-slider grid-container hide" data-slide-vendors="<?php echo ($index + 1); ?>">
                        <?php $vendorsArray = array_slice($array, 0, 5);?>
                        <?php foreach( $vendorsArray as $user ):
                            $vendor = get_wcmp_vendor( $user );
                            $image = $vendor->get_image() ? $vendor->get_image('image', array(300, 300)) : $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
                            $address = $vendor->get_formatted_address() ? substr( $vendor->get_formatted_address(), 0, 25) : '';
                            $permalink = $vendor->get_permalink();  
                            $vendor_name = substr(esc_html($vendor->page_title), 0, 20);
                            $banner = $vendor->get_image('banner') ? $vendor->get_image('banner') : false;
                            $products = $vendor->get_products() ? $vendor->get_products( array( 'posts_per_page' => 3 ) ) : false;
                        ?>
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
                                    <p class="vendor-address"> <?php echo $address ?>... </p>
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
                        <?php endforeach;?>
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