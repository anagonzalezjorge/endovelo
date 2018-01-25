<?php 
// Shortcode para añadir botón personalizado en Divi
add_shortcode( 'divi_custom_button', 'generate_divi_custom_button' );
function generate_divi_custom_button( $atts ){

    $atts = shortcode_atts( array(
        'texto' => 'VER MÁS',
        'url' => '#',
        'tcolor' => '#fff',
        'bgcolor' => ''
    ), $atts, 'divi_custom_button' );

    $html_button  = '<a class="et_pb_promo_button et_pb_button" style="padding-bottom: 0.3em; margin: 15px 0 10px 0; ';
    $html_button .= !empty( $atts[ 'bgcolor' ] )? 'background-color: ' . $atts[ 'bgcolor' ] : '';
    $html_button .= '; color: '. $atts[ 'tcolor' ] .' !important;" href="'. $atts[ 'url' ] .'">'. $atts[ 'texto' ] .'</a>';

    return $html_button;
}
//Elimina productos relacionados de la ficha de producto
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
//Elimina Ordenar por
remove_action ('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
?>

<?php
add_action( 'after_setup_theme', 'layerswoo_theme_setup' );
function layerswoo_theme_setup() {
   add_theme_support( 'wc-product-gallery-zoom' );
   add_theme_support( 'wc-product-gallery-lightbox' );
   add_theme_support( 'wc-product-gallery-slider' );
}
?>