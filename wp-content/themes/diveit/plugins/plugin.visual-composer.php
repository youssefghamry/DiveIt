<?php
/* WPBakery PageBuilder support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_vc_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_vc_theme_setup', 1 );
	function diveit_vc_theme_setup() {
		if (diveit_exists_visual_composer()) {

			add_action('diveit_action_add_styles',		 				'diveit_vc_frontend_scripts' );
		}
		if (is_admin()) {
			add_filter( 'diveit_filter_required_plugins',					'diveit_vc_required_plugins' );
		}
	}
}

// Check if WPBakery PageBuilder installed and activated
if ( !function_exists( 'diveit_exists_visual_composer' ) ) {
	function diveit_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if WPBakery PageBuilder in frontend editor mode
if ( !function_exists( 'diveit_vc_is_frontend' ) ) {
	function diveit_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'diveit_vc_required_plugins' ) ) {
		function diveit_vc_required_plugins($list=array()) {
		if (in_array('visual_composer', diveit_storage_get('required_plugins'))) {
			$path = diveit_get_file_dir('plugins/install/js_composer.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> 'WPBakery PageBuilder',
					'slug' 		=> 'js_composer',
					'version'   => '6.9.0',
					'source'	=> $path,
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Enqueue VC custom styles
if ( !function_exists( 'diveit_vc_frontend_scripts' ) ) {
		function diveit_vc_frontend_scripts() {
		if (file_exists(diveit_get_file_dir('css/plugin.visual-composer.css')))
			wp_enqueue_style( 'diveit-plugin-visual-composer-style',  diveit_get_file_url('css/plugin.visual-composer.css'), array(), null );
	}
}



?>