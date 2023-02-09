<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_essgrids_theme_setup')) {
    add_action( 'diveit_action_before_init_theme', 'diveit_essgrids_theme_setup', 1 );
    function diveit_essgrids_theme_setup() {
        // Register shortcode in the shortcodes list

        if (is_admin()) {
            add_filter( 'diveit_filter_required_plugins',				'diveit_essgrids_required_plugins' );
        }
    }
}


// Check if Ess. Grid installed and activated
if ( !function_exists( 'diveit_exists_essgrids' ) ) {
    function diveit_exists_essgrids() {
        return defined('EG_PLUGIN_PATH') || defined('ESG_PLUGIN_PATH');
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'diveit_essgrids_required_plugins' ) ) {
        function diveit_essgrids_required_plugins($list=array()) {
        if (in_array('essgrids', diveit_storage_get('required_plugins'))) {
            $path = diveit_get_file_dir('plugins/install/essential-grid.zip');
            if (file_exists($path)) {
                $list[] = array(
                    'name' 		=> esc_html__('Essential Grid', 'diveit'),
                    'slug' 		=> 'essential-grid',
                    'source'	=> $path,
                    'version'      => '3.0.15',
                    'required' 	=> false
                );
            }
        }
        return $list;
    }
}

?>