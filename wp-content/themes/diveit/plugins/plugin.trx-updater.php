<?php
/* ThemeREX Updater support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_trx_updater_theme_setup')) {
    add_action( 'diveit_action_before_init_theme', 'diveit_trx_updater_theme_setup', 1 );
    function diveit_trx_updater_theme_setup() {
        if (is_admin()) {
            add_filter( 'diveit_filter_required_plugins', 'diveit_trx_updater_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'diveit_exists_trx_updater' ) ) {
    function diveit_exists_trx_updater() {
        return function_exists( 'trx_updater_load_plugin_textdomain' );
    }
}



// Filter to add in the required plugins list
if ( !function_exists( 'diveit_trx_updater_required_plugins' ) ) {
    function diveit_trx_updater_required_plugins($list=array()) {
        if (in_array('trx_updater', diveit_storage_get('required_plugins'))) {
            $path = diveit_get_file_dir('plugins/install/trx_updater.zip');
            if (file_exists($path)) {
                $list[] = array(
                    'name' 		=> esc_html__('ThemeREX Updater', 'diveit'),
                    'slug' 		=> 'trx_updater',
                    'source'	=> $path,
                    'version'   => '1.9.9',
                    'required' 	=> false
                );
            }
        }
        return $list;
    }
}