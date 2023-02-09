<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_booked_theme_setup')) {
    add_action( 'diveit_action_before_init_theme', 'diveit_booked_theme_setup', 1 );
    function diveit_booked_theme_setup() {
        // Register shortcode in the shortcodes list
        if (diveit_exists_booked()) {
            add_action('diveit_action_add_styles', 					'diveit_booked_frontend_scripts');
        }
        if (is_admin()) {
            add_filter( 'diveit_filter_required_plugins',				'diveit_booked_required_plugins' );
        }
    }
}


// Check if plugin installed and activated
if ( !function_exists( 'diveit_exists_booked' ) ) {
    function diveit_exists_booked() {
        return class_exists('booked_plugin');
    }
}


// Filter to add in the required plugins list
if ( !function_exists( 'diveit_booked_required_plugins' ) ) {
        function diveit_booked_required_plugins($list=array()) {
        if (in_array('booked', (array)diveit_storage_get('required_plugins'))) {
            $path = diveit_get_file_dir('plugins/install/booked.zip');
            if (!empty($path) && file_exists($path)) {
                $list[] = array(
                    'name'         => esc_html__('Booked', 'diveit'),
                    'slug'         => 'booked',
                    'version'      => '2.3.5',
                    'source'    => $path,
                    'required'     => false
                );
            }
        }
        return $list;
    }
}

// Enqueue custom styles
if ( !function_exists( 'diveit_booked_frontend_scripts' ) ) {
        function diveit_booked_frontend_scripts() {
        if (file_exists(diveit_get_file_dir('css/plugin.booked.css')))
            wp_enqueue_style( 'diveit-plugin-booked-style',  diveit_get_file_url('css/plugin.booked.css'), array(), null );
    }
}



// Lists
//------------------------------------------------------------------------

// Return booked calendars list, prepended inherit (if need)
if ( !function_exists( 'diveit_get_list_booked_calendars' ) ) {
    function diveit_get_list_booked_calendars($prepend_inherit=false) {
        return diveit_exists_booked() ? diveit_get_list_terms($prepend_inherit, 'booked_custom_calendars') : array();
    }
}

?>