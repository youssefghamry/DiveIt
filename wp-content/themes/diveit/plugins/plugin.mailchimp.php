<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_mailchimp_theme_setup')) {
    add_action( 'diveit_action_before_init_theme', 'diveit_mailchimp_theme_setup', 1 );
    function diveit_mailchimp_theme_setup() {

        if (is_admin()) {

            add_filter( 'diveit_filter_required_plugins',					'diveit_mailchimp_required_plugins' );
        }
    }
}

// Check if Instagram Feed installed and activated
if ( !function_exists( 'diveit_exists_mailchimp' ) ) {
    function diveit_exists_mailchimp() {
        return function_exists('mc4wp_load_plugin');
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'diveit_mailchimp_required_plugins' ) ) {
        function diveit_mailchimp_required_plugins($list=array()) {
        if (in_array('mailchimp', diveit_storage_get('required_plugins')))
            $list[] = array(
                'name' 		=> esc_html__('MailChimp for WP', 'diveit'),
                'slug' 		=> 'mailchimp-for-wp',
                'required' 	=> false
            );
        return $list;
    }
}


?>
