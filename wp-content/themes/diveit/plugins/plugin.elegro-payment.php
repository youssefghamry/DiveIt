<?php
/* elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_woocommerce_elegro_payment_theme_setup')) {
    add_action( 'diveit_action_before_init_theme', 'diveit_woocommerce_elegro_payment_theme_setup', 1 );
    function diveit_woocommerce_elegro_payment_theme_setup() {
        if (is_admin()) {
            add_filter( 'diveit_filter_required_plugins', 'diveit_woocommerce_elegro_payment_required_plugins' );
        }
    }
}

// Check if elegro Crypto Payment installed and activated
if ( !function_exists( 'diveit_exists_woocommerce_elegro_payment' ) ) {
    function diveit_exists_woocommerce_elegro_payment() {
        return function_exists('init_Elegro_Payment');
    }
}


// Filter to add in the required plugins list
if ( !function_exists( 'diveit_woocommerce_elegro_payment_required_plugins' ) ) {
    function diveit_woocommerce_elegro_payment_required_plugins($list=array()) {
        if (in_array('elegro-payment', (array)diveit_storage_get('required_plugins')))
            $list[] = array(
                'name' 		=> esc_html__('elegro Crypto Payment', 'diveit'),
                'slug' 		=> 'elegro-payment',
                'required' 	=> false
            );
        return $list;
    }
}
