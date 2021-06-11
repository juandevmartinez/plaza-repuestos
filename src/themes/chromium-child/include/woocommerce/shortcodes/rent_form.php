<?php 

    function rent_form(){
        ob_start();
        ?>
        <div class="rent-notification">
            <h2>Hola, <?php echo get_vendor_store_name( get_current_user_id() ); ?>.</h2>
            <p>Se ha vencido el arriendo de tu local. Por favor, renueva tu contrato por:</p>
        </div>
        <form action="<?php echo get_site_url();?>/checkout/" method="post">
            <select name="add-to-cart" id="rent-woocommerce">
                <option value="4058">1 mes de arriendo</option>
                <option value="4060">6 meses de arriendo</option>
                <option value="4060">1 año de arriendo</option>
            </select>
            <button type="submit" class="button-primary">Pagar Arriendo</button>
        </form>
        <?php
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
    add_shortcode( 'rent_form', 'rent_form' );
?>
