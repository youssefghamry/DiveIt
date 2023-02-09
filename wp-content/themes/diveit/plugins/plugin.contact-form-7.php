<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_contact_form_7_theme_setup')) {
    add_action( 'diveit_action_before_init_theme', 'diveit_contact_form_7_theme_setup', 1 );
    function diveit_contact_form_7_theme_setup() {
        if (is_admin()) {
            add_filter( 'diveit_filter_required_plugins', 'diveit_contact_form_7_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'diveit_exists_contact_form_7' ) ) {
    function diveit_exists_contact_form_7() {
        return defined( 'Contact Form 7' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'diveit_contact_form_7_required_plugins' ) ) {
        function diveit_contact_form_7_required_plugins($list=array()) {
        if (in_array('contact_form_7', (array)diveit_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Contact Form 7', 'diveit'),
                'slug'         => 'contact-form-7',
                'required'     => false
            );
        return $list;
    }
}
