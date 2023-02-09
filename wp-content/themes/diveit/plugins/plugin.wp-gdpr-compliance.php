<?php
/* Cookie Information support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_wp_gdpr_compliance_theme_setup')) {
    add_action( 'diveit_action_before_init_theme', 'diveit_wp_gdpr_compliance_theme_setup', 1 );
    function diveit_wp_gdpr_compliance_theme_setup() {
        if (is_admin()) {
            add_filter( 'diveit_filter_required_plugins', 'diveit_wp_gdpr_compliance_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'diveit_exists_wp_gdpr_compliance' ) ) {
    function diveit_exists_wp_gdpr_compliance() {
        return defined( 'WP_GDPR_Compliance_VERSION' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'diveit_wp_gdpr_compliance_required_plugins' ) ) {
        function diveit_wp_gdpr_compliance_required_plugins($list=array()) {
        if (in_array('wp_gdpr_compliance', (array)diveit_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Cookie Information', 'diveit'),
                'slug'         => 'wp-gdpr-compliance',
                'required'     => false
            );
        return $list;
    }
}
