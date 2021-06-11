<?php

function plaza_slider_custom_page() {
    
    add_menu_page(
        'Locales Destacados', // page <title>Title</title>
		'Locales Destacados', // menu link text
		'manage_options', // capability to access the page
		'locales-destacados', // page URL slug
		'plaza_slider_page_content', // callback function with content
		'dashicons-admin-generic', // icon
		5 // priority
	);
    
}
add_action( 'admin_menu', 'plaza_slider_custom_page' );

function plaza_slider_page_content(){
    $slides = get_slides_from_slider();
    echo '<div class="wrap">
	<h1>Locales Destacados</h1>
	<form method="post" action="options.php">';
    settings_fields( 'vendor_slider' );
    do_settings_sections('locales-destacados');
    submit_button();
		
	echo '</form></div>';
}

/**
 * Get slides from revolution slider
 * @param slider ID of the slider you want get the slides 
 * @return array of slides_id
 */
function get_slides_from_slider( $slider = null ){
    global $wpdb;

    $slider = 1;
    $results = $wpdb->get_results("SELECT * FROM `wp_revslider_slides` WHERE `slider_id` = $slider");
    $slides = [];
    foreach( $results as $result ){
        $slides[] = $result->id;
    }
    return $slides;   
}

function creating_fields_for_slider_vendors(){

    $slides = get_slides_from_slider();
    foreach( $slides as $index => $slide ){
        register_setting( 
            'vendor_slider', 
            'vendor_slider_' . $index, 
            array('type' => 'array') 
        );
        add_settings_section( 
            'vendor_slider_section_' . $index,
            '', 
            '', 
            'locales-destacados' 
        );
        add_settings_field( 
            'vendor_slider_' . $index, 
            'Locales para slider #' . ($index + 1), 
            'display_select2_vendors', 
            'locales-destacados', 
            'vendor_slider_section_' . $index, 
            array( 
                'label_for' => 'vendor_slider_' . $index,
                'class' => 'slider-vendors',
            )
        );
    }
    
   
    
}
add_action('admin_init', 'creating_fields_for_slider_vendors');

/**
 * Display multiple selection
 */
function display_select2_vendors( $args ){
    
    $name = $args['label_for'];
    $option = get_option( $name );  
	
    $query = array(
        'role'      =>  'dc_vendor',
        'orderby'   =>  'user_nicename',
        'order'     =>  'ASC'
    );
    $users = get_users( $query );
    ob_start();
    ?>
    <p>
        <label for="<?php echo $name ?>">Seleccione un local:</label><br>
        <select class="slider-vendors" name="<?php echo $name ?>[]" multiple="multiple" style="width:99%;max-width:25em;">
        <?php foreach( $users as $user ):
            $selected = in_array( $user->ID, $option ) ? 'selected="selected"' : '';    
        ?>
            <option value="<?php echo $user->ID ?>" <?php echo $selected ?>><?php echo get_user_meta( $user->ID,'_vendor_page_title', true );?></option>
        <?php endforeach; ?>
        </select>
    </p>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
}