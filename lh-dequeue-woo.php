<?php
/*
Plugin Name: LH Dequeue Woo
Plugin URI: https://lhero.org/portfolio/lh-dequeue-woo/
Description: Plugin to dequeue Woocommerce styles and scripts
Version: 1.01
Author: Peter Shaw
Author URI: https://shawfactor.com/
*/

if (!class_exists('LH_dequeue_woo_plugin')) {


class LH_dequeue_woo_plugin {





// Remove each style one by one


public function dequeue_woo_styles( $enqueue_styles ) {

if ( !is_cart() && !is_checkout()) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation


}

return $enqueue_styles;
}







public function manage_woocommerce_styles() {

if (function_exists( 'is_cart' ) and function_exists( 'is_checkout' )){

remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
if ( !is_cart() && !is_checkout()) {
wp_dequeue_style( 'select2' );
wp_dequeue_script( 'wc-add-to-cart' );
wp_dequeue_script( 'select2' );
  //wp_deregister_script('jquery-blockui' );
wp_dequeue_script( 'jquery-blockui' );
wp_deregister_script('woocommerce' );
wp_dequeue_script( 'woocommerce' );
wp_dequeue_script( 'jquery-cookie' );
wp_dequeue_script( 'wc-cart-fragments' );
wp_dequeue_script( 'wc-country-select' );
wp_dequeue_script( 'wc-address-i18n' );
wp_dequeue_script( 'wc-add-to-cart-variation' );
wp_dequeue_script( 'wcqi-js' );

}


}}

public function remove_woo_commerce_generator_tag(){
remove_action( 'get_the_generator_html', 'wc_generator_tag', 10 );
remove_action( 'get_the_generator_xhtml', 'wc_generator_tag', 10 );
}



public function __construct() {
    
add_filter( 'woocommerce_enqueue_styles', array($this,"dequeue_woo_styles") );

add_action( 'wp_enqueue_scripts', array($this,"manage_woocommerce_styles"), 99 );
add_action('get_header',array($this,"remove_woo_commerce_generator_tags"));

    
}



}

$lh_dequeue_woo_instance = new LH_dequeue_woo_plugin();

}


?>