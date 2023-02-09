<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_gutenberg_theme_setup')) {
    add_action( 'diveit_action_before_init_theme', 'diveit_gutenberg_theme_setup', 1 );
    function diveit_gutenberg_theme_setup() {
        if (is_admin()) {
            add_filter( 'diveit_filter_required_plugins', 'diveit_gutenberg_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'diveit_exists_gutenberg' ) ) {
    function diveit_exists_gutenberg() {
        return function_exists( 'the_gutenberg_project' ) && function_exists( 'register_block_type' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'diveit_gutenberg_required_plugins' ) ) {
        function diveit_gutenberg_required_plugins($list=array()) {
        if (in_array('gutenberg', (array)diveit_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Gutenberg', 'diveit'),
                'slug'         => 'gutenberg',
                'required'     => false
            );
        return $list;
    }
}